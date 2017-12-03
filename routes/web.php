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

	//Route for Approval
	Route::get('/approval',['as'=>'approval.index','uses'=>'ApprovalController@index']);
	Route::get('/approval/create',['as'=>'approval.create','uses'=>'ApprovalController@create']);


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



		//Route for Monitoring SubMenu quick Real Count
	Route::get('/monitoring/quickrealcount',['as'=>'monitoring.quickrealcount','uses'=>'monitoring\QuickRealCountController@index']);



		//Route for Monitoring SubMenu Foto
	Route::get('/monitoring/presensipetugas',['as'=>'monitoring.presensipetugas','uses'=>'monitoring\PresensiPetugasController@index']);

	//End Route For Menu MONITORING--------------------------------------------------------------------------------------------

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
	Route::get('/datamaster/TPS/update/{id}',['as'=>'datamaster.TPS.update', 'uses'=>'data_master\TPSController@update']);
	Route::get('/datamaster/TPS/store',['as'=>'datamaster.TPS.store', 'uses'=>'data_master\TPSController@update']);
	Route::get('/datamaster/TPS/{id}',['as'=>'datamaster.TPS.delete', 'uses'=>'datamaster\TPSController@destroy']);
		//EndTPS
		//Dapil
	Route::get('/datamaster/dapil',['as'=>'datamaster.dapil.index', 'uses'=>'data_master\DapilController@index']);
	Route::get('/datamaster/dapil/ajax',['as'=>'datamaster.dapil.ajax', 'uses'=>'data_master\DapilController@ajax']);
	Route::get('/datamaster/dapil/getdatatable',['as'=>'datamaster.dapil.datatable', 'uses'=>'data_master\DapilController@get_datatable']);
	Route::get('/datamaster/dapil/create',['as'=>'datamaster.dapil.create', 'uses'=>'data_master\DapilController@create']);
	Route::get('/datamaster/dapil/edit/{id}',['as'=>'datamaster.dapil.edit', 'uses'=>'data_master\DapilController@edit']);
	Route::patch('/datamaster/dapil/update/{id}',['as'=>'datamaster.dapil.edit', 'uses'=>'data_master\DapilController@edit']);
	Route::patch('/datamaster/dapil/store',['as'=>'datamaster.dapil.edit', 'uses'=>'data_master\DapilController@edit']);
	Route::get('/datamaster/dapil/{id}',['as'=>'datamaster.dapil.delete', 'uses'=>'data_master\DapilController@destroy']);
		//EndDapil
		//Calon
	Route::get('/datamaster/calon', ['as'=>'datamaster.calon.index', 'uses'=>'data_master\TPSController@index']);
	Route::get('/datamaster/calon/create',['as'=>'datamaster.calon.create', 'uses'=>'data_master\TPSController@create']);
	Route::get('/datamaster/calon/edit/{id}',['as'=>'datamaster.calon.edit', 'uses'=>'data_master\TPSController@edit']);
	Route::get('/datamaster/calon/update/{id}',['as'=>'datamaster.calon.edit', 'uses'=>'data_master\TPSController@update']);
	Route::get('/datamaster/calon/store',['as'=>'datamaster.calon.store', 'uses'=>'data_master\TPSController@update']);
	Route::get('/datamaster/calon/{id}',['as'=>'datamaster.calon.delete', 'uses'=>'data_master\TPSController@destroy']);
		//EndCalon
		//Partai
		Route::get('/datamaster/partai',['as'=>'datamaster.partai.index', 'uses'=>'data_master\DapilController@index']);
		Route::get('/datamaster/partai/ajax',['as'=>'datamaster.partai.ajax', 'uses'=>'data_master\DapilController@ajax']);
		Route::get('/datamaster/partai/getdatatable',['as'=>'datamaster.partai.datatable', 'uses'=>'data_master\DapilController@get_datatable']);
		Route::get('/datamaster/partai/create',['as'=>'datamaster.partai.create', 'uses'=>'data_master\DapilController@create']);
		Route::get('/datamaster/partai/edit/{id}',['as'=>'datamaster.partai.edit', 'uses'=>'data_master\DapilController@edit']);
		Route::patch('/datamaster/partai/update/{id}',['as'=>'datamaster.partai.edit', 'uses'=>'data_master\DapilController@edit']);
		Route::patch('/datamaster/partai/store',['as'=>'datamaster.partai.edit', 'uses'=>'data_master\DapilController@edit']);
		Route::get('/datamaster/partai/{id}',['as'=>'datamaster.partai.delete', 'uses'=>'data_master\DapilController@destroy']);
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

	Route::post('/logout', [
		'as' => 'logout',
		'uses' => 'SentinelAuth\LoginController@postLogout'
	]);

});
