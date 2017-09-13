<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginTerakhirController extends Controller
{
    public function index()
    {
    	return view('layouts.monitoring.login_terakhir.index');
    }
}
