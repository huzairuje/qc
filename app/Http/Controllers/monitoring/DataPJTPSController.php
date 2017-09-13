<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataPJTPSController extends Controller
{
    public function index()
    {
    	return view('layouts.monitoring.data_pj_tps.index');
    }
}
