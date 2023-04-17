<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Message;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use File;
use Auth;

class UserController extends Controller
{
    public function profile_update(Request $request)
    {
        // return $request->all();
        $validated = $request->validate([
            'avatar' => 'nullable|file|image',
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore(Auth::user()->id)],
        ]);

        $user = User::find(Auth::user()->id);
        $avatar = $user->avatar;
        if (request()->hasFile('avatar')) {
            //old image delete after updating
            if(File::exists('storage/'.$user->avatar)) {
                if($user->avatar){
                    unlink('storage/'.$user->avatar);
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
            $avatar = 'user-avatar/avatar-' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('avatar')->storeAs('public', $avatar);
        }
        $user->avatar = $avatar;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        if ($user) {
            return redirect()
                ->back()
                ->with('success', 'Information Updated Successfully');
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

        $user = User::find(Auth::user()->id);
        if (!(Hash::check($request->get('old_password'), $user->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }
        $user->password = Hash::make($request->password);
        $user->save();

        //$datas = Admin::latest()->get();
        if ($user) {
            return redirect()->back()->with('success', 'Password Updated Successfully');
        } else {
            return redirect()->back()->with('error', 'Upps!! Something Error.');
        }
    }

    public function message_history()
    {
        return view('message-history',[
            'messages' => Message::where('user_id', Auth::user()->id)->get()
        ]);
    }
}
