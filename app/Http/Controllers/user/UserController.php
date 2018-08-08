<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('auth.user.profile', ['user' => Auth::user()]);
    }

    public function showChangePasswordForm()
    {
        return view('auth.passwords.changepassword');
    }

    public function changePassword(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($validatedData['new-password']);
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");

    }

    public function edit()
    {
        return view('auth.user.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
        ]);

        $user = Auth::user();
        $user->update($validatedData);

        if ($request->file('image') != null) {
            $user->img_path = $request->file('image')->store('avatar', 'public');
        }
        $user->save();

        return redirect('/profile');
    }

}
