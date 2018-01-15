<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Auth::routes();
// Route::post('/register', 'RegisterController@register');
// Route::post('/login', 'LoginController@login');
// Route::post('/logout', 'LoginController@logout');

Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [
		'as' => 'register',
		'uses' => 'SentinelAuth\RegisterController@getRegister'
	]);

	Route::get('/login', [
		'as' => 'login',
		'uses' => 'SentinelAuth\LoginController@getLogin'
	]);

	Route::post('/login', [
		'as' => 'login',
		'uses' => 'SentinelAuth\LoginController@postLogin'
	]);

	Route::get('/forgot-password', [
		'as' => 'password.request',
		'uses' => 'SentinelAuth\LoginController@getLogin'
	]);
});

Route::group(['middleware' => 'jwt.auth'], function () {
	Route::get('user', 'UserController@getAuthUser');
});

Route::group(['middleware' => 'admin'], function () {
	Route::get('/',['as'=>'dashboard','uses'=>'DashboardController@index']);

	//Route For user
	Route::get('/users', 'UserController@profile')->name('users.profile');
	Route::patch('/users/{id}', 'UserController@update')->name('users.update');

	//Route for Tabulasi
	Route::get('/tabulasi/quickcount',['as'=>'tabulasi.quickcount','uses'=>'TabulasiController@quickCount']);
	Route::get('/tabulasi/ajax',['as'=>'tabulasi.ajax','uses'=>'TabulasiController@ajax']);
	Route::get('/tabulasi', ['as'=>'tabulasi.index','uses'=>'TabulasiController@index']);
	Route::get('/tabulasi/getdatatable', ['as' => 'tabulasi.datatable',   'uses' => 'TabulasiController@get_datatable']);
	Route::get('/tabulasi/create',['as'=>'tabulasi.create','uses'=>'TabulasiController@create']);
	Route::get('/tabulasi/show/{id}',['as'=>'tabulasi.show','uses'=>'TabulasiController@show']);
	Route::get('/tabulasi/edit/{id}',['as'=>'tabulasi.edit','uses'=>'TabulasiController@edit']);
	Route::patch('/tabulasi/update/{id}',['as'=>'tabulasi.update','uses'=>'TabulasiController@update']);
	Route::post('/tabulasi/store',['as'=>'tabulasi.store','uses'=>'TabulasiController@store']);
	Route::get('/tabulasi/{id}', ['as' => 'tabulasi.delete', 'uses' => 'TabulasiController@destroy']);


	//Route for download
	Route::get('/download',['as'=>'download','uses'=>'DownloadController@index']);

	//Route for Monitoring Menu quick Real Count
	Route::get('/quickrealcount',['as'=>'quickrealcount.index','uses'=>'monitoring\QuickRealCountController@index']);

	//Route For Menu MONITORING--------------------------------------------------------------------------------------------

	//Route for Monitoring SubMenu DataSaksi
	Route::get('/monitoring/datasaksi',['as'=>'monitoring.datasaksi','uses'=>'monitoring\DataSaksiController@index']);
	Route::get('/monitoring/datasaksi/getdatatable', ['as'=>'monitoring.datasaksi.datatable', 'uses' => 'monitoring\DataSaksiController@get_datatable']);
	Route::get('/monitoring/datasaksi/create',['as'=>'monitoring.datasaksi.create','uses'=>'monitoring\DataSaksiController@create']);
	Route::get('/monitoring/datasaksi/show/{id}',['as'=>'monitoring.datasaksi.show','uses'=>'monitoring\DataSaksiController@show']);
	Route::get('/monitoring/datasaksi/edit/{id}',['as'=>'monitoring.datasaksi.edit','uses'=>'monitoring\DataSaksiController@edit']);
	Route::patch('/monitoring/datasaksi/update/{id}',['as'=>'monitoring.datasaksi.update','uses'=>'monitoring\DataSaksiController@update']);
	Route::post('/monitoring/datasaksi/store',['as'=>'monitoring.datasaksi.store','uses'=>'monitoring\DataSaksiController@store']);
	Route::get('/monitoring/datasaksi/{id}',['as'=>'monitoring.datasaksi.delete','uses'=>'monitoring\DataSaksiController@destroy']);



	//Route for Monitoring SubMenu Data PJ TPS
	Route::get('/monitoring/datapjtps',['as'=>'monitoring.datapjtps','uses'=>'monitoring\DataPJTPSController@index']);
	Route::get('/monitoring/datapjtps/getdatatable', ['as'=>'monitoring.datapjtps.datatable', 'uses' => 'monitoring\DataPJTPSController@get_datatable']);
	Route::get('/monitoring/datapjtps/create',['as'=>'monitoring.datapjtps.create','uses'=>'monitoring\DataPJTPSController@create']);
	Route::get('/monitoring/datapjtps/show/{id}',['as'=>'monitoring.datapjtps.show','uses'=>'monitoring\DataPJTPSController@show']);
	Route::get('/monitoring/datapjtps/edit/{id}',['as'=>'monitoring.datapjtps.edit','uses'=>'monitoring\DataPJTPSController@edit']);
	Route::patch('/monitoring/datapjtps/update/{id}',['as'=>'monitoring.datapjtps.update','uses'=>'monitoring\DataPJTPSController@update']);
	Route::post('/monitoring/datapjtps/store',['as'=>'monitoring.datapjtps.store','uses'=>'monitoring\DataPJTPSController@store']);
	Route::get('/monitoring/datapjtps/{id}',['as'=>'monitoring.datapjtps.delete','uses'=>'monitoring\DataPJTPSController@destroy']);




	//Route for Monitoring SubMenu Tabulasi
	Route::get('/monitoring/tabulasi',['as'=>'monitoring.tabulasi','uses'=>'monitoring\TabulasiController@index']);



	//Route for Monitoring SubMenu Foto
	Route::get('/monitoring/foto',['as'=>'monitoring.foto','uses'=>'monitoring\FotoController@index']);



	//Route for Monitoring SubMenu Login Terakhir
	Route::get('/monitoring/loginterakhir',['as'=>'monitoring.loginterakhir','uses'=>'monitoring\LoginTerakhirController@index']);
	Route::get('/monitoring/loginterakhir/getdatatable',['as'=>'monitoring.loginterakhir.datatable','uses'=>'monitoring\LoginTerakhirController@get_datatable']);
	Route::get('/monitoring/loginterakhir/show/{id}',['as'=>'monitoring.loginterakhir.show','uses'=>'monitoring\LoginTerakhirController@show']);







	//Route for Monitoring SubMenu Foto
	Route::get('/monitoring/presensipetugas',['as'=>'monitoring.presensipetugas','uses'=>'monitoring\PresensiPetugasController@index']);

	//End Route For Menu MONITORING--------------------------------------------------------------------------------------------

	//Route For Absensi
	Route::get('/absensi',['as'=>'absensi.index','uses'=>'AbsensiController@index']);
	// Route::get('/absensi/ajax',['as'=>'absensi.ajax','uses'=>'AbsensiController@ajax']);
	Route::get('/absensi/getdatatable', ['as'=>'absensi.datatable', 'uses' => 'AbsensiController@get_datatable']);
	// Route::get('/absensi/create',['as'=>'absensi.create','uses'=>'AbsensiController@create']);
	Route::get('/absensi/show/{id}',['as'=>'absensi.show','uses'=>'AbsensiController@show']);
	Route::get('/absensi/edit/{id}',['as'=>'absensi.edit','uses'=>'AbsensiController@edit']);
	Route::patch('/absensi/update/{id}',['as'=>'absensi.update','uses'=>'AbsensiController@update']);
	// Route::post('/absensi/store',['as'=>'absensi.store','uses'=>'AbsensiController@store']);
	Route::get('/absensi/{id}',['as'=>'absensi.delete','uses'=>'AbsensiController@destroy']);
	//End Route For Absensi

	//Route For APPROVAL
	Route::get('/approval',['as'=>'approval.index','uses'=>'ApprovalController@index']);
	Route::get('/approval/ajax',['as'=>'approval.ajax','uses'=>'ApprovalController@ajax']);
	Route::get('/approval/getdatatable', ['as'=>'approval.datatable', 'uses' => 'ApprovalController@get_datatable']);
	Route::get('/approval/create',['as'=>'approval.create','uses'=>'ApprovalController@create']);
	Route::get('/approval/show/{id}',['as'=>'approval.show','uses'=>'ApprovalController@show']);
	Route::get('/approval/edit/{id}',['as'=>'approval.edit','uses'=>'ApprovalController@edit']);
	Route::patch('/approval/update/{id}',['as'=>'approval.update','uses'=>'ApprovalController@update']);
	Route::post('/approval/store',['as'=>'approval.store','uses'=>'ApprovalController@store']);
	Route::get('/approval/{id}',['as'=>'approval.delete','uses'=>'ApprovalController@destroy']);
	//End Route For Approval

	//Route for Event
	Route::get('/event',['as'=>'event.index','uses'=>'EventController@index']);
	Route::get('/event/ajax',['as'=>'event.ajax','uses'=>'EventController@ajax']);
	Route::get('/event/getdatatable', ['as'=>'event.datatable', 'uses' => 'EventController@get_datatable']);
	Route::get('/event/create',['as'=>'event.create','uses'=>'EventController@create']);
	Route::get('/event/show/{id}',['as'=>'event.show','uses'=>'EventController@show']);
	Route::get('/event/edit/{id}',['as'=>'event.edit','uses'=>'EventController@edit']);
	Route::patch('/event/update/{id}',['as'=>'event.update','uses'=>'EventController@update']);
	Route::post('/event/store',['as'=>'event.store','uses'=>'EventController@store']);
	Route::get('/event/{id}',['as'=>'event.delete','uses'=>'EventController@destroy']);
	//End Route for Event

	//Route for data master
	// Route::get('/datamaster',['as'=>'datamaster.index','uses'=>'DataMasterController@index']);
	// Route::get('/datamaster/create',['as'=>'datamaster.create','uses'=>'DataMasterController@create']);
	//TPS
	Route::get('/datamaster/TPS',['as'=>'datamaster.TPS.index', 'uses'=>'data_master\TPSController@index']);
	Route::get('/datamaster/TPS/ajax',['as'=>'datamaster.TPS.ajax', 'uses'=>'data_master\TPSController@ajax']);
	Route::get('/datamaster/TPS/getdatatable',['as'=>'datamaster.TPS.datatable', 'uses'=>'data_master\TPSController@get_datatable']);
	Route::get('/datamaster/TPS/create',['as'=>'datamaster.TPS.create', 'uses'=>'data_master\TPSController@create']);
	Route::get('/datamaster/TPS/edit/{id}',['as'=>'datamaster.TPS.edit', 'uses'=>'data_master\TPSController@edit']);
	Route::patch('/datamaster/TPS/update/{id}',['as'=>'datamaster.TPS.update', 'uses'=>'data_master\TPSController@update']);
	Route::post('/datamaster/TPS/store',['as'=>'datamaster.TPS.store', 'uses'=>'data_master\TPSController@store']);
	Route::get('/datamaster/TPS/show/{id}',['as'=>'datamaster.TPS.show', 'uses'=>'data_master\TPSController@show']);
	Route::get('/datamaster/TPS/{id}',['as'=>'datamaster.TPS.delete', 'uses'=>'data_master\TPSController@destroy']);
	//EndTPS
	//Dapil
	Route::get('/datamaster/dapil',['as'=>'datamaster.dapil.index', 'uses'=>'data_master\DapilController@index']);
	Route::get('/datamaster/dapil/ajax',['as'=>'datamaster.dapil.ajax', 'uses'=>'data_master\DapilController@ajax']);
	Route::get('/datamaster/dapil/getdatatable',['as'=>'datamaster.dapil.datatable', 'uses'=>'data_master\DapilController@get_datatable']);
	Route::get('/datamaster/dapil/create',['as'=>'datamaster.dapil.create', 'uses'=>'data_master\DapilController@create']);
	Route::get('/datamaster/dapil/edit/{id}',['as'=>'datamaster.dapil.edit', 'uses'=>'data_master\DapilController@edit']);
	Route::patch('/datamaster/dapil/update/{id}',['as'=>'datamaster.dapil.update', 'uses'=>'data_master\DapilController@update']);
	Route::post('/datamaster/dapil/store',['as'=>'datamaster.dapil.store', 'uses'=>'data_master\DapilController@store']);
	Route::get('/datamaster/dapil/show/{id}',['as'=>'datamaster.dapil.show', 'uses'=>'data_master\DapilController@show']);
	Route::get('/datamaster/dapil/{id}',['as'=>'datamaster.dapil.delete', 'uses'=>'data_master\DapilController@destroy']);
	//EndDapil
	//Calon
	Route::get('/datamaster/calon', ['as'=>'datamaster.calon.index', 'uses'=>'data_master\CalonController@index']);
	Route::get('/datamaster/calon/ajax', ['as'=>'datamaster.calon.ajax', 'uses'=>'data_master\CalonController@ajax']);
	Route::get('/datamaster/calon/getdatatable', ['as'=>'datamaster.calon.datatable', 'uses'=>'data_master\CalonController@get_datatable']);
	Route::get('/datamaster/calon/create',['as'=>'datamaster.calon.create', 'uses'=>'data_master\CalonController@create']);
	Route::get('/datamaster/calon/edit/{id}',['as'=>'datamaster.calon.edit', 'uses'=>'data_master\CalonController@edit']);
	Route::patch('/datamaster/calon/update/{id}',['as'=>'datamaster.calon.update', 'uses'=>'data_master\CalonController@update']);
	Route::post('/datamaster/calon/store',['as'=>'datamaster.calon.store', 'uses'=>'data_master\CalonController@store']);
	Route::get('/datamaster/calon/show/{id}',['as'=>'datamaster.calon.show','uses'=>'data_master\CalonController@show']);
	Route::get('/datamaster/calon/{id}',['as'=>'datamaster.calon.delete', 'uses'=>'data_master\CalonController@destroy']);
	//EndCalon
	//Partai
	Route::get('/datamaster/partai',['as'=>'datamaster.partai.index', 'uses'=>'data_master\PartaiController@index']);
	Route::get('/datamaster/partai/ajax',['as'=>'datamaster.partai.ajax', 'uses'=>'data_master\PartaiController@ajax']);
	Route::get('/datamaster/partai/getdatatable',['as'=>'datamaster.partai.datatable', 'uses'=>'data_master\PartaiController@get_datatable']);
	Route::get('/datamaster/partai/create',['as'=>'datamaster.partai.create', 'uses'=>'data_master\PartaiController@create']);
	Route::get('/datamaster/partai/edit/{id}',['as'=>'datamaster.partai.edit', 'uses'=>'data_master\PartaiController@edit']);
	Route::patch('/datamaster/partai/update/{id}',['as'=>'datamaster.partai.update', 'uses'=>'data_master\PartaiController@edit']);
	Route::post('/datamaster/partai/store',['as'=>'datamaster.partai.store', 'uses'=>'data_master\PartaiController@store']);
	Route::get('/datamaster/partai/show/{id}',['as'=>'datamaster.partai.show','uses'=>'data_master\PartaiController@show']);
	Route::get('/datamaster/partai/{id}',['as'=>'datamaster.partai.delete', 'uses'=>'data_master\PartaiController@destroy']);
	//EndPartai
	//Route for User Management
	Route::get('/user-management',['as'=>'usermanagement.index','uses'=>'UserManagementController@index']);
	Route::get('/user-management/ajax',['as'=>'user-management.ajax','uses'=>'UserManagementController@ajax']);
	Route::get('/user-management/getdatatable', ['as'=>'user-management.datatable', 'uses' => 'UserManagementController@get_datatable']);
	Route::get('/user-management/create',['as'=>'usermanagement.create','uses'=>'UserManagementController@create']);
	Route::post('/user-management',['as'=>'usermanagement.store','uses'=>'UserManagementController@store']);
	Route::get('/user-management/edit/{id}',['as'=>'usermanagement.edit','uses'=>'UserManagementController@edit']);
	Route::patch('/user-management/update/{id}',['as'=>'usermanagement.update','uses'=>'UserManagementController@update']);
	Route::get('/user-management/show/{id}',['as'=>'usermanagement.show','uses'=>'UserManagementController@show']);
	Route::delete('/user-management/{id}',['as'=>'usermanagement.destroy','uses'=>'UserManagementController@destroy']);

	Route::get('/assign-user',['as'=>'assignuser.index','uses'=>'AssignUserController@index']);
	Route::get('/assign-user/ajax',['as'=>'assignuser.ajax','uses'=>'AssignUserController@ajax']);
	Route::get('/assign-user/getdatatable', ['as'=>'assignuser.datatable', 'uses' => 'AssignUserController@get_datatable']);
	Route::get('/assign-user/create',['as'=>'assignuser.create','uses'=>'AssignUserController@create']);
	Route::post('/assign-user',['as'=>'assignuser.store','uses'=>'AssignUserController@store']);
	Route::get('/assign-user/edit/{id}',['as'=>'assignuser.edit','uses'=>'AssignUserController@edit']);
	Route::patch('/assign-user/update/{id}',['as'=>'assignuser.update','uses'=>'AssignUserController@update']);
	Route::get('/assign-user/show/{id}',['as'=>'assignuser.show','uses'=>'AssignUserController@show']);
	Route::delete('/assign-user/{id}',['as'=>'assignuser.destroy','uses'=>'AssignUserController@destroy']);

	Route::post('/logout', [
		'as' => 'logout',
		'uses' => 'SentinelAuth\LoginController@postLogout'
	]);

});
