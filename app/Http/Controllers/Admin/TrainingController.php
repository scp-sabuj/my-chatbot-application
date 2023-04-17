<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Training;
use App\Models\Settings;
use Auth;

use Phpml\Classification\NaiveBayes;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WhitespaceTokenizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Pipeline;


use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;

class TrainingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('admin')->user()->role_id == 1) {
            // if admin is supper admin
            $training_datas = Training::with('admin')->get();
        }else{
            $training_datas = Training::with('admin')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        }
        $page = 'index';
        return view('admin.pages.training.index', compact('training_datas', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:255'],
        ]);

        $training = New Training;
        $training->admin_id = Auth::guard('admin')->user()->id;
        $training->question = $request->question;
        $training->answer = $request->answer;
        $training->save();

        if ($training) {
            return redirect()
                ->back()
                ->with('success', 'Data Stored Successfully');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong, try again.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::guard('admin')->user()->role_id == 1) {
            // if admin is supper admin
            $training_datas = Training::with('admin')->get();
        }else{
            $training_datas = Training::with('admin')->where('admin_id', Auth::guard('admin')->user()->id)->get();
        }
        $page = 'edit';
        $data = Training::find($id);
        return view('admin.pages.training.index', compact('training_datas', 'page', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'question' => ['required', 'string', 'max:255'],
            'answer' => ['required', 'string', 'max:255'],
        ]);

        $training = Training::find($id);
        $training->admin_id = Auth::guard('admin')->user()->id;
        $training->question = $request->question;
        $training->answer = $request->answer;
        $training->save();

        if ($training) {
            return redirect()
                ->back()
                ->with('success', 'Data Updated Successfully');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong, try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $training = Training::find($id);
        $training->delete();

        if ($training) {
            $type = app('App\Http\Controllers\Admin\Auth\AdminAuthController')->admin_role();
            return redirect()
                ->route($type.'.training.index')
                ->with('success', 'Data Deleted Successfully');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong, try again.');
        }
    }

    public function status_change($id)
    {
        $training = Training::find($id);
        if ($training->status == 1) {
            $training->status = 0;
            $msg = 'Data Active Successfully';
        } else {
            $training->status = 1;
            $msg = 'Data Inactive Successfully';
        }
        $training->save();

        if ($training) {
            return redirect()
                ->back()
                ->with('success', $msg);
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong, try again.');
        }
    }

    public function train()
    {
        $settings = Settings::first();
        $training_done = false;
        if ($settings->used_algorithm == 1) {
            $res = $this->SVMTraining();
            if ($res == 0) {
                return redirect()
                ->back()
                ->with('warning', 'There is no training data.');
            }
            $training_done = true;
        } else {
            $res = $this->NaiveBayesTraining();
            if ($res == 0) {
                return redirect()
                ->back()
                ->with('warning', 'There is no training data.');
            }
            $training_done = true;
        }
        
        if ($training_done == true) {
            return redirect()
                ->back()
                ->with('success', 'Machine Trained Successfully.');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong, try again.');
        }
        
    }

    public function SVMTraining()
    {
        // Retrieve all responses from the database
        $responses = Training::where('status', 1)->get();
        if (count($responses) == 0) {
            return 0;
        }

        $trainingData = [];
        $labels = [];

        // Prepare training data
        foreach ($responses as $response) {
            // Skip null or empty question
            if (!empty($response->question)) {
                $trainingData[] = $response->question;
                $labels[] = $response->answer;
            }
        }

        // Train SVM model
        $classifier = new SVC(Kernel::RBF);
        $vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());
        $transformer = new TfIdfTransformer();

        $pipeline = new Pipeline([$vectorizer, $transformer], $classifier);
        $pipeline->train($trainingData, $labels);

        // Save trained model to file
        $filename = 'svm_model.dat';
        file_put_contents($filename, serialize($pipeline));

        return "SVM model trained successfully and saved to {$filename}";
    }
    public function NaiveBayesTraining()
    {
        // Retrieve all responses from the database
        $responses = Training::where('status', 1)->get();
        if (count($responses) == 0) {
            return 0;
        }

        $trainingData = [];
        $labels = [];

        // Prepare training data
        foreach ($responses as $response) {
            // Skip null or empty question
            if (!empty($response->question)) {
                $trainingData[] = $response->question;
                $labels[] = $response->answer;
            }
        }

        // Train Naive Bayes model
        $classifier = new NaiveBayes();
        $vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());
        $transformer = new TfIdfTransformer();

        $pipeline = new Pipeline([$vectorizer, $transformer], $classifier);
        $pipeline->train($trainingData, $labels);

        // Save trained model to file
        $filename = 'naive_bayes_model.dat';
        file_put_contents($filename, serialize($pipeline));

        return "Naive Bayes model trained successfully and saved to {$filename}";
    }
}
