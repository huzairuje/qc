<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Flash;

class UserController extends Controller
{
    public function profile(Request $id)
    {
		return view('layouts.users.profile', array('user' => Auth::user()) );
        
    }

    public function update($id, Request $request)
    {
            $user = User::findOrFail($id);
                if (empty($user)) {
                    flash('User not found')->error();

                    return redirect(route('users.profile'));
                }
 
            $user->name       = $request->name;
            $user->email       = $request->email;
            $user->password    = bcrypt($request->password);
            
            $user->update();


        return redirect(route('users.profile'));
    }
}
