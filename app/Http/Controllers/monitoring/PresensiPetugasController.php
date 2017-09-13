<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PresensiPetugasController extends Controller
{
    public function index()
    {
        return view('layouts.monitoring.presensi_petugas.index');
    }
}
