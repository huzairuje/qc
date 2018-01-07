<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Sentinel;
use Flash;

class UserController extends Controller
{
    public function profile(Request $id)
    {
        $user = Sentinel::findOrFail();
		    return view('layouts.users.profile', compact('user'));

    }

    public function update($id, Request $request)
    {
            $user = Sentinel::findOrFail($id);
                if (empty($user)) {
                    flash('User not found')->error();

                    return redirect(route('users.profile'));
                }

            $user->name       = $request->name;
            $user->email       = $request->email;
            $user->password    = bcrypt($request->password);

            $user->update();

            flash('User Profile updated successfully')->success();
        return redirect(route('users.profile'));
    }
}
