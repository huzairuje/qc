<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataPJTPSMonitoring;

class MonitoringDatapjtpsAPIController extends Controller
{
    public function index()
	{
		$datapjtps = DataPJTPSMonitoring::all();
		// dd($tabulasi);
		return response()->json($datapjtps);
	}
}
