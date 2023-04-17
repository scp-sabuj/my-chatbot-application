<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Settings;
use App\Models\Admin;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use File;
use Auth;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard',[
            'settings' => Settings::first()
        ]);
    }

    public function profile_update(Request $request)
    {
        // return $request->all();
        $validated = $request->validate([
            'avatar' => 'nullable|file|image',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('admins', 'email')->ignore(Auth::guard('admin')->user()->id)],
        ]);

        $admin = Admin::find(Auth::guard('admin')->user()->id);
        $avatar = $admin->avatar;
        if (request()->hasFile('avatar')) {
            //old image delete after updating
            if(File::exists('storage/'.$admin->avatar)) {
                if($admin->avatar){
                    unlink('storage/'.$admin->avatar);
                }
            }

            // Get filename with the extension
            $filenameWithExt = $request->file('avatar')->getClientOriginalName();
            $filenameWithExt = str_replace(' ', '', $filenameWithExt);
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('avatar')->getClientOriginalExtension();
            // Filename to store
            $avatar = 'admin-avatar/avatar-' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('avatar')->storeAs('public', $avatar);
        }
        $admin->avatar = $avatar;
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        if ($admin) {
            return redirect()
                ->back()
                ->with('success', 'Updated Successfully');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Something went wrong, try again.');
        }
    }

    public function password_update(Request $request)
    {
        $request->validate([
            'old_password' => 'required|string|min:8', new MatchOldPassword,
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string|min:8',
        ]);

        $admin = Admin::find(Auth::guard('admin')->user()->id);
        if (!(Hash::check($request->get('old_password'), $admin->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }
        $admin->password = Hash::make($request->password);
        $admin->save();

        //$datas = Admin::latest()->get();
        if ($admin) {
            return redirect()->back()->with('success', 'Password Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Upps!! Something Error.');
        }
    }


    public function change_algorithm(Request $request)
    {
        
        $request->validate([
            'algorithm' => 'required',
        ]);

        $settings = Settings::first();
        $settings->used_algorithm = $request->algorithm;
        $settings->save();

        if ($settings) {
            return redirect()->back()->with('success', 'Algorithm Changed Successfully');
        } else {
            return redirect()->back()->with('error', 'Upps!! Something Error.');
        }
    }
}
