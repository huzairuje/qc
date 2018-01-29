<?php

namespace App\Http\Controllers\monitoring;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;


class QuickRealCountController extends Controller
{
    public function index()
    {
    	$event = Event::dropdown();
      	// return view('layouts.dashboard.index', compact('event'));
    	return view('layouts.monitoring.quick_real_count.index', compact('event'));
    }

    public function ajax(Request $request)
    {
      if($request->first){
      	$event = Event::chart()->orderBy("event.created_at", "desc")->get();        
      }else{
       	$event = Event::chart()->where("event.id", $event_id)->get();
      }
      return response()->json($event);

    }
}
