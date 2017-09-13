<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DataSaksiController extends Controller
{
    public function index()
    {
        return view('layouts.monitoring.data_saksi.index');
    }
}
