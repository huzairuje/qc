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

    public function dataSaksi()
    {
        return view('layouts.monitoring.data_saksi');
    }

    public function dataSaksiGerindra()
    {
        return view('layouts.monitoring.data_saksi');
    }

    public function dataPjTps()
    {
    	return view('layouts.monitoring.data_pj_tps');
    }

    public function presensiPetugas()
    {
        return view('layouts.monitoring.presensi_petugas');
    }

    public function tabulasi()
    {
    	return view('layouts.monitoring.tabulasi_monitoring');
    }

    public function foto()
    {
    	return view('layouts.monitoring.foto');
    }

    public function loginTerakhir()
    {
    	return view('layouts.monitoring.login_terakhir');
    }

    public function quickRealCount()
    {
    	return view('layouts.monitoring.quick_real_count.blade.php');
    }
}
