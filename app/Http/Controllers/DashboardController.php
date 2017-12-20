<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Charts;
use App\Models\Provinsi;
use App\Models\Event;
use App\Models\Dapil;
use App\Models\DapilLokasi;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

      $data['events'] = Event::all()->where('id', 1);
      $data['dapilLokasi'] = DapilLokasi::all();
      return view('layouts.dashboard.index', $data);
    }
}
