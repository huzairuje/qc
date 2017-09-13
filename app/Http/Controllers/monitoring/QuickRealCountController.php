<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuickRealCountController extends Controller
{
    public function index()
    {
    	return view('layouts.monitoring.quick_real_count.index');
    }
}
