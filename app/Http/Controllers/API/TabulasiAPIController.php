<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tabulasi;

class TabulasiAPIController extends Controller
{
    public function index()
	{
		$tabulasi = Tabulasi::all();
		// dd($tabulasi);
		return response()->json($tabulasi);
	}

}
