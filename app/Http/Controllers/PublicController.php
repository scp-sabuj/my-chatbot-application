<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Message;
use App\Models\Training;
use Auth;

class PublicController extends Controller
{
    public function welcome()
    {
        return view('welcome',[
            'messages' => Auth::check() ? Message::where('user_id', Auth::user()->id)->get() : array()
        ]);
    }

    public function send_message(Request $request)
    {
        $query = $request->input('message');
        $request->validate([
            'message' => 'required|string|max:255',
        ]);
        $training_datas = Training::where('status', 1)->get();
        if (count($training_datas) > 0) {
            return $this->handleChat($query);
        }
        return response()->json(['status' => 404, 'msg' => 'No Training Data Found']);
    }

    // Handle user queries
    public function handleChat($query)
    {
        // Get user query
        $query = $query;

        // Load trained model from file
        $filename = 'svm_model.dat';
        $model = unserialize(file_get_contents($filename));
        // return $query;

        // Predict response using trained model
        $response = $model->predict([$query]);

        // Convert predicted response to string
        $predictedResponse = $response[0];

        if (Auth::check()) {
            $msg = New Message;
            $msg->user_id = Auth::user()->id;
            $msg->question = $query;
            $msg->answer = $predictedResponse;
            $msg->save();
        }

        // Return predicted response as JSON
        return response()->json(['response' => $predictedResponse]);
    }
}
