<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserEvent;
use App\Models\RoleUser;
use App\Models\Event;
use Sentinel;

class UserManagementController extends Controller
{
    public function index(){
        $thisUserId = Sentinel::getUser()->id;
        if($thisUserId != 1){
            $users = User::where('parent_id', $thisUserId)->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        return view('layouts.user-management.index',compact('users'));
    }

    public function create(){
        $role = Sentinel::getUser()->roles()->first()->slug;

        if ($role == 'admin-pusat')
        {
            $data['roleList']['2'] = 'Admin Event';
            $data['roleList']['3'] = 'Admin Provinsi';
            $data['roleList']['4'] = 'Admin Kota';
            $data['roleList']['5'] = 'Admin Kecamatan';
            $data['roleList']['6'] = 'Admin Korsak';
            $data['roleList']['7'] = 'Saksi';
        }
        elseif  ($role == 'admin-event')
        {
            $data['roleList']['3'] = 'Admin Provinsi';
            $data['roleList']['4'] = 'Admin Kota';
            $data['roleList']['5'] = 'Admin Kecamatan';
            $data['roleList']['6'] = 'Admin Korsak';
            $data['roleList']['7'] = 'Saksi';
        }
        elseif ($role == 'admin-provinsi')
        {
            $data['roleList']['4'] = 'Admin Kota';
            $data['roleList']['5'] = 'Admin Kecamatan';
            $data['roleList']['6'] = 'Admin Korsak';
            $data['roleList']['7'] = 'Saksi';
        }
        elseif ($role == 'admin-kota')
        {
            $data['roleList']['5'] = 'Admin Kecamatan';
            $data['roleList']['6'] = 'Admin Korsak';
            $data['roleList']['7'] = 'Saksi';
        }
        else
        {
            $data['roleList']['6'] = 'Admin Korsak';
            $data['roleList']['7'] = 'Saksi';
        }

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

        return view('layouts.user-management.create', $data);
    }

    public function store(Request $request){

      $v = $this->validate($request,[
        'first_name' => 'required',
         // 'tingkat_id' => 'required',
         'email' => 'required',
         'username' => 'required',
         'phone' => 'required',

          ]);

        if($request->role == 'korsak' || $request->role == 'saksi')
        {
            $phone_pass = $request->phone;
            // $request['password'] = substr($phone_pass, 6);
            $request->merge([
                'parent_id' => Sentinel::getUser()->id,
                'password' => substr($phone_pass, 6),
            ]);
            // dd($request->all());

            $user = Sentinel::register($request->all());
        }
        else
        {
            $request->merge([
            'password' => '12345678',
            'parent_id' => Sentinel::getUser()->id,
            ]);

            $user = Sentinel::registerAndActivate($request->all());
        }

        $insertedId = $user->id;

        Sentinel::findRoleById($request->role)->users()->attach( $user );

        try
        {
            $user = new UserEvent;
            $user->user_id = $insertedId;
            $user->event_id = $request->event;
            $user->save();
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }

        $data = $request->data;
        foreach($data as $key => $event){
            $userEvent[$key] = ['user_id' => $insertedId, 'event_id' => $event];
        }
        UserEvent::insert($userEvent);

        // return redirect('/user-management/show/' . $insertedId);
        return redirect(route('usermanagement.show', $insertedId));

    }

    public function show($id){
        $data['user'] = User::where('id' , '=', $id)->first();
        return view('layouts.user-management.detail', $data);
    }

    public function edit($id){
        $data['user'] = User::where('id' , '=', $id)->first();

        if($data['user']->roles()->first()->id <= Sentinel::getUser()->id){

            flash('You are not Authorized and you cannot Edit Yourself')->error();
            return redirect(route('usermanagement.index'));
            // return 'You are not authorized.';

        }
        else
        {
            $role = Sentinel::getUser()->roles()->first()->slug;

            if ($role == 'admin-pusat')
            {
                $data['roleList']['2'] = 'Admin Event';
                $data['roleList']['3'] = 'Admin Provinsi';
                $data['roleList']['4'] = 'Admin Kota';
                $data['roleList']['5'] = 'Admin Kecamatan';
                $data['roleList']['6'] = 'Admin Korsak';
                $data['roleList']['7'] = 'Saksi';
            }
            elseif  ($role == 'admin-event')
            {
                $data['roleList']['3'] = 'Admin Provinsi';
                $data['roleList']['4'] = 'Admin Kota';
                $data['roleList']['5'] = 'Admin Kecamatan';
                $data['roleList']['6'] = 'Admin Korsak';
                $data['roleList']['7'] = 'Saksi';
            }
            elseif ($role == 'admin-provinsi')
            {
                $data['roleList']['4'] = 'Admin Kota';
                $data['roleList']['5'] = 'Admin Kecamatan';
                $data['roleList']['6'] = 'Admin Korsak';
                $data['roleList']['7'] = 'Saksi';
            }
            elseif ($role == 'admin-kota')
            {
                $data['roleList']['5'] = 'Admin Kecamatan';
                $data['roleList']['6'] = 'Admin Korsak';
                $data['roleList']['7'] = 'Saksi';
            }
            else
            {
                $data['roleList']['6'] = 'Admin Korsak';
                $data['roleList']['7'] = 'Saksi';
            }

            $currentDataList = UserEvent::all()->where('user_id', $id);
            if (count($currentDataList) != 0) {
                foreach ($currentDataList as $key => $currentData) {
                    $data['currentDataList'][$key] = $currentData->lokasi_id;
                }
            } else {
                $data['currentDataList'] = [];
            }

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

            return view('layouts.user-management.edit', $data);
        }
    }

    public function update(Request $request, $id){
        $data = User::find($id);
        $currentRole = $data->roles()->first()->id;
        // $currentEvent = $data->UserEvent()->first()->id;
        $currentEvent = $data->userEvent->first()->id;
        // dd($currentRole);

        if (empty($data)) {

            flash('User not found');

            return redirect(route('user-management.index'));
        }

        $data->update($request->all());
        try {
            $currentRole != $request->role;
            $role = RoleUser::where('user_id', $id)->first();
            $role->role_id = $request->role;
            $role->update();

            $currentEvent != $request->event;
            foreach($data as $key => $event){
                $userEvent[$key] = ['user_id' => $insertedId, 'event_id' => $event];
            }
            UserEvent::update($userEvent);
            
            $event = UserEvent::where('event_id', $id)->first();
            $event->event_id = $request->event;
            $event->update();
           
            // dd($event);

        }catch(\Exception $e){
            echo $e->getMessage(); 
        }



        flash('User update successfully')->success();
        // return redirect('/user-management/show/' . $id);
        return redirect(route('usermanagement.index', $id));

    }

    public function destroy($id){
        return redirect(route('usermanagement.index', $id));
        // return redirect('/user-management/show/' . $id);
    }
}
