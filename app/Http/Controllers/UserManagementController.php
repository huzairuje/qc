<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\User;
=======
use App\User;
use App\UserEvent;
use App\Event;
>>>>>>> 68070a30006cc1848115d977ad07afbc34baa7f6
use Sentinel;

class UserManagementController extends Controller
{
    public function index(){
        $data['users'] = User::paginate(10);
        return view('layouts.user-management.index', $data);
    }

    public function create(){
        $role = Sentinel::getUser()->roles()->first()->slug;

        if ($role == 'admin-pusat')
        {
            $data['roleList']['admin-event'] = 'Admin Event';
            $data['roleList']['admin-provinsi'] = 'Admin Provinsi';
            $data['roleList']['admin-kota'] = 'Admin Kota';
            $data['roleList']['admin-kecamatan'] = 'Admin Kecamatan';
            $data['roleList']['korsak'] = 'Admin Korsak';
            $data['roleList']['saksi'] = 'Saksi';
        }
        elseif  ($role == 'admin-event')
        {
            $data['roleList']['admin-provinsi'] = 'Admin Provinsi';
            $data['roleList']['admin-kota'] = 'Admin Kota';
            $data['roleList']['admin-kecamatan'] = 'Admin Kecamatan';
            $data['roleList']['korsak'] = 'Admin Korsak';
            $data['roleList']['saksi'] = 'Saksi';
        }
        elseif ($role == 'admin-provinsi')
        {
            $data['roleList']['admin-kota'] = 'Admin Kota';
            $data['roleList']['admin-kecamatan'] = 'Admin Kecamatan';
            $data['roleList']['korsak'] = 'Admin Korsak';
            $data['roleList']['saksi'] = 'Saksi';
        }
        elseif ($role == 'admin-kota')
        {
            $data['roleList']['admin-kecamatan'] = 'Admin Kecamatan';
            $data['roleList']['korsak'] = 'Admin Korsak';
            $data['roleList']['saksi'] = 'Saksi';
        }
        else
        {
            $data['roleList']['korsak'] = 'Admin Korsak';
            $data['roleList']['saksi'] = 'Saksi';
        }

        $userEvents = UserEvent::all()->where('user_id', Sentinel::getUser()->id);
        foreach ($userEvents as $key => $userEvent) {
            $listEventId[$key] = $userEvent->event_id;
        }
        if(count($userEvents) != 0)
        {
            $data['eventList'] = Event::all()->whereIn('id', $listEventId);
        }
        else
        {
            $data['eventList'] = Event::all()->where('id', 0);
        }

        return view('layouts.user-management.create', $data);
    }

    public function store(Request $request){
        $request->merge([
            'password' => '12345678',
        ]);
        // dd($request->all());
        if($request->role == 'korsak' || $request->role == 'saksi')
        {
            $user = Sentinel::register($request->all());
        }
        else
        {
            $user = Sentinel::registerAndActivate($request->all());
        }

        $insertedId = $user->id;

        Sentinel::findRoleBySlug($request->role)->users()->attach( $user );

<<<<<<< HEAD
        return redirect('/user-management/show/' . $insertedId);
    }

    public function show($id){
        $data['user'] = User::where('id' , '=', $id)->first();
        return view('layouts.user-management.detail', $data);
    }

    public function edit($id){
        $data['user'] = User::where('id' , '=', $id)->first();
=======
        try
        {
           $user = new UserEvent;
           $user->user_id = $user->id;
           $user->event_id = $request->event;
           $user->save();
       }
       catch(\Exception $e){
           echo $e->getMessage();
       }

       return redirect('/user-management/show/' . $insertedId);
   }

   public function show($id){
    $data['user'] = User::where('id' , '=', $id)->first();
    return view('layouts.user-management.detail', $data);
}

public function edit($id){
    $data['user'] = User::where('id' , '=', $id)->first();

    if($data['user']->roles()->first()->id <= Sentinel::getUser()->id){
        return 'You are not authorized.';
    }
    else
    {
        $role = Sentinel::getUser()->roles()->first()->slug;
>>>>>>> 68070a30006cc1848115d977ad07afbc34baa7f6

        if ($role == 'admin-pusat')
        {
            $data['roleList']['admin-event'] = 'Admin Event';
            $data['roleList']['admin-kota'] = 'Admin Kota';
            $data['roleList']['admin-kecamatan'] = 'Admin Kecamatan';
            $data['roleList']['korsak'] = 'Admin Korsak';
            $data['roleList']['saksi'] = 'Saksi';
        }
        elseif  ($role == 'admin-event')
        {
<<<<<<< HEAD
            $role = Sentinel::getUser()->roles()->first()->slug;

            if ($role == 'admin-pusat')
            {
                $data['roleList']['admin-event'] = 'Admin Event';
                $data['roleList']['admin-kota'] = 'Admin Kota';
                $data['roleList']['admin-kecamatan'] = 'Admin Kecamatan';
                $data['roleList']['korsak'] = 'Admin Korsak';
                $data['roleList']['saksi'] = 'Saksi';
            }
            elseif  ($role == 'admin-event')
            {
                $data['roleList']['admin-kota'] = 'Admin Kota';
                $data['roleList']['admin-kecamatan'] = 'Admin Kecamatan';
                $data['roleList']['korsak'] = 'Admin Korsak';
                $data['roleList']['saksi'] = 'Saksi';
            }
            elseif ($role == 'admin-kota')
            {
                $data['roleList']['admin-kecamatan'] = 'Admin Kecamatan';
                $data['roleList']['korsak'] = 'Admin Korsak';
                $data['roleList']['saksi'] = 'Saksi';
            }
            else
            {
                $data['roleList']['korsak'] = 'Admin Korsak';
                $data['roleList']['saksi'] = 'Saksi';
            }

            return view('layouts.user-management.edit', $data);
=======
            $data['roleList']['admin-kota'] = 'Admin Kota';
            $data['roleList']['admin-kecamatan'] = 'Admin Kecamatan';
            $data['roleList']['korsak'] = 'Admin Korsak';
            $data['roleList']['saksi'] = 'Saksi';
>>>>>>> 68070a30006cc1848115d977ad07afbc34baa7f6
        }
        elseif ($role == 'admin-kota')
        {
            $data['roleList']['admin-kecamatan'] = 'Admin Kecamatan';
            $data['roleList']['korsak'] = 'Admin Korsak';
            $data['roleList']['saksi'] = 'Saksi';
        }
        else 
        {
            $data['roleList']['korsak'] = 'Admin Korsak';
            $data['roleList']['saksi'] = 'Saksi';
        }

        return view('layouts.user-management.edit', $data);
    }
<<<<<<< HEAD

    public function update(Request $request, $id){
    	return redirect('/user-management/show/' . $id);
    }

    public function destroy($id){
        return redirect('/user-management/show/' . $id);
    }
=======
}

public function update(Request $request, $id){
 return redirect('/user-management/show/' . $id);
}

public function destroy($id){
    return redirect('/user-management/show/' . $id);
}
>>>>>>> 68070a30006cc1848115d977ad07afbc34baa7f6
}
