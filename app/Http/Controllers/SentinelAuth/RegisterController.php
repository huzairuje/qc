<?php

namespace App\Http\Controllers\SentinelAuth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;

class RegisterController extends Controller
{
    public function getRegister()
    {
    	return view('sentinel-auth.register');
    }

    public function postRegister(Request $request)
    {
    	$user = Sentinel::registerAndActivate($request->all());

    	return redirect('/');
    }
}
