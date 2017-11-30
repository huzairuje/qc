<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    public function index(){
    	return view('layouts.user-management.create');
    }
    
    public function create(){
    	return view('layouts.user-management.create');
    }
    
    public function store(Request $request){
    	return redirect('/usermanagement/detail/1');
    }
    
    public function show($id){
    	return view('layouts.user-management.detail');
    }
    
    public function edit($id){
    	return view('layouts.user-management.edit');
    }
    
    public function update(Request $request, $id){
    	return redirect('/usermanagement/detail/1');
    }
    
    public function destroy($id){
    	return redirect('/usermanagement/detail/1');
    }
}
