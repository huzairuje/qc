<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Sentinel;
use Auth;
use Flash;

class UserController extends Controller
{
    public function profile(Request $id)
    {
            $user = Sentinel::getUser();
        
		    return view('layouts.users.profile', compact('user'));

    }

    public function update($id, Request $request)
    {
            $user = User::findOrFail($id);
                if (empty($user)) {
                    flash('User not found')->error();

                    return redirect(route('users.profile'));
                }

            $user->username       = $request->username;
            $user->email       = $request->email;
            $user->password    = bcrypt($request->password);

            $user->update();

            flash('User Profile updated successfully')->success();
        return redirect(route('users.profile'));
    }
}
