<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Datasaksi_monitoring;

class MonitoringDataSaksiAPIController extends Controller
{
    public function index()
	{
		$datasaksi = Datasaksi_monitoring::all();
		// dd($tabulasi);
		return response()->json($datasaksi);
	}
}
