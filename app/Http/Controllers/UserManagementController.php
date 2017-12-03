<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
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

        return view('layouts.user-management.create', $data);
    }
    
    public function store(Request $request){
        $request->merge([
            'password' => '12345678',
        ]);
        // dd($request->all());
        $user = Sentinel::registerAndActivate($request->all());
        $insertedId = $user->id;

        Sentinel::findRoleBySlug($request->role)->users()->attach( $user );

        return redirect('/user-management/show/' . $insertedId);
    }
    
    public function show($id){
        $data['user'] = User::where('id' , '=', $id)->first();
        return view('layouts.user-management.detail', $data);
    }
    
    public function edit($id){
        $data['user'] = User::where('id' , '=', $id)->first();

        if($data['user']->roles()->first()->id < Sentinel::getUser()->id){
            return 'You are not authorized.';
        }
        else
        {
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
        }
    }
    
    public function update(Request $request, $id){
    	return redirect('/user-management/show/' . $id);
    }
    
    public function destroy($id){
        return redirect('/user-management/show/' . $id);
    }
}
