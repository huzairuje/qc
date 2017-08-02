<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MonitoringController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function dataSaksiPks()
    {
        return view('layouts.monitoring.index');
    }

    public function dataSaksiGerindra()
    {
        return view('layouts.monitoring.create');
    }

    public function dataPjTps()
    {
    	return view('layouts.monitoring');
    }

    public function tabulasi()
    {
    	return view('layouts.monitoring');
    }

    public function foto()
    {
    	return view('layouts.monitoring');
    }

    public function loginTerakhir()
    {
    	return view('layouts.monitoring');
    }

    public function quickRealCount()
    {
    	return view('layouts.monitoring');
    }
}
