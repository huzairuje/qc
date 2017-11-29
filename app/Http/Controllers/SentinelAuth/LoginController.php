<?php

namespace App\Http\Controllers\SentinelAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;

class LoginController extends Controller
{
    public function getLogin()
    {
    	return view('auth.login');
    }

    public function postLogin(Request $request)
    {
    	Sentinel::authenticate($request->all());

    	if(Sentinel::check())
            return redirect('/');
        else
            return redirect('/login');
    }

    public function postLogout()
    {
    	Sentinel::logout();

    	return redirect('/login');
    }
}
