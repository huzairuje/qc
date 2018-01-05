<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Models\User;
use App\Models\UserEvent;
use App\Models\RoleUser;
use App\Models\Event;

class AssignUserController extends Controller
{
    public function index()
    {
        $thisUserId = Sentinel::getUser()->id;
        if($thisUserId != 1){
            $users = User::where('parent_id', $thisUserId)->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        return view('layouts.assign-user.index',compact('users'));
    }

    public function edit($id){
        $data['user'] = User::where('id' , '=', $id)->first();

        $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
        }
        if(count($userEvents) != 0)
        {
            $data['eventList'] = Event::all()->whereIn('id', $listEventId)->where('expired', '>', date('Y-m-d'));
        }
        else
        {
            $data['eventList'] = Event::all()->where('id', 0);
        }
        if($data['user']->roles()->first()->id <= Sentinel::getUser()->id){
            return 'You are not authorized.';
        }
        else
        {
            $currentDataList = UserEvent::all()->where('user_id', $id);
            if (count($currentDataList) != 0) {
                foreach ($currentDataList as $key => $currentData) {
                    $data['currentDataList'][$key] = $currentData->event_id;
                }
            } else {
                $data['currentDataList'] = [];
            }

            return view('layouts.assign-user.edit', $data);
        }
    }

    public function update(Request $request, $id){
        $currentDapilList = UserEvent::all()->where('user_id', $id);
        if (count($currentDapilList) != 0) {
            foreach ($currentDapilList as $key => $currentData) {
                $currentDataList[$key] = $currentData->lokasi_id;
            }
        } else {
            $currentDataList = [];
        }

        $data = $request->data;

        $deletes = array_diff($currentDataList, $data);
        $adds = array_diff($data, $currentDataList);
        if (count($deletes) != 0) {
            foreach ($deletes as $key => $delete) {
                UserEvent::find($delete)->delete();
            }
        }
        if (count($adds) != 0) {
            foreach($adds as $key => $lokasi){
                $dapilLokasi[$key] = ['user_id' => $id, 'event_id' => $lokasi];
            }
            UserEvent::insert($dapilLokasi);
        }


        flash('User update successfully')->success();
        return redirect('/assign-user/show/' . $id);
    }

    public function show($id){
        $data['user'] = User::where('id' , '=', $id)->first();
        return view('layouts.assign-user.detail', $data);
    }
}
