<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Provinsi;
use App\Models\Event;
use App\Models\Calon;
use App\Models\Dapil;
use App\Models\DapilLokasi;
// use App\Models\DapilLokasi;
use Charts;

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
      $event = Event::dropdown();
      return view('layouts.dashboard.index', compact('event'));
      
    }


    public function ajax(Request $request)
    {
      $event = Event::chart()->where("event.id", $request->event_id)->get();
      return response()->json($event);

    }

            
}
