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

// Route::group(['middleware' => 'jwt.auth'], function () {
// 	Route::get('user', 'UserController@getAuthUser');
// });

Route::group(['middleware' => 'admin'], function () {

	//Route for Dashboard
	Route::get('/',['as'=>'dashboard','uses'=>'DashboardController@index']);
	Route::post('/ajax',['as'=>'dashboard.ajax','uses'=>'DashboardController@ajax']);
	//End Route for Dashboard

	//Route For user
	Route::get('/users', 'UserController@profile')->name('users.profile');
	Route::patch('/users/{id}', 'UserController@update')->name('users.update');

	//Route for Tabulasi
	Route::get('/tabulasi/quickcount',['as'=>'tabulasi.quickcount','uses'=>'TabulasiController@quickCount']);
	Route::get('/tabulasi/ajax',['as'=>'tabulasi.ajax','uses'=>'TabulasiController@ajax']);
	// Route::get('/tabulasi/ajaxchart',['as'=>'tabulasi.ajaxchart','uses'=>'TabulasiController@ajaxChart']);
	Route::get('/tabulasi', ['as'=>'tabulasi.index','uses'=>'TabulasiController@index']);
	Route::get('/tabulasi/getdatatable', ['as' => 'tabulasi.datatable',   'uses' => 'TabulasiController@get_datatable']);
	Route::get('/tabulasi/create',['as'=>'tabulasi.create','uses'=>'TabulasiController@create']);
	Route::get('/tabulasi/show/{id}',['as'=>'tabulasi.show','uses'=>'TabulasiController@show']);
	Route::get('/tabulasi/edit/{id}',['as'=>'tabulasi.edit','uses'=>'TabulasiController@edit']);
	Route::patch('/tabulasi/update/{id}',['as'=>'tabulasi.update','uses'=>'TabulasiController@update']);
	Route::post('/tabulasi/store',['as'=>'tabulasi.store','uses'=>'TabulasiController@store']);
	Route::get('/tabulasi/{id}', ['as' => 'tabulasi.delete', 'uses' => 'TabulasiController@destroy']);
	//End Route for Tabulasi

	//Route for download
	Route::get('/download',['as'=>'download','uses'=>'DownloadController@index']);

	//Route for Monitoring Menu quick Real Count
	Route::get('/quickrealcount',['as'=>'quickrealcount.index','uses'=>'monitoring\QuickRealCountController@index']);
	//End Route for Monitoring Menu Quick Real Count


	//Route For Menu MONITORING
		//Route for Monitoring SubMenu DataSaksi
		Route::get('/monitoring/datasaksi',['as'=>'monitoring.datasaksi','uses'=>'monitoring\DataSaksiController@index']);
		Route::get('/monitoring/datasaksi/ajax',['as'=>'monitoring.datasaksi.ajax','uses'=>'monitoring\DataSaksiController@ajax']);
		Route::get('/monitoring/datasaksi/getdatatable', ['as'=>'monitoring.datasaksi.datatable', 'uses' => 'monitoring\DataSaksiController@get_datatable']);
		Route::get('/monitoring/datasaksi/create',['as'=>'monitoring.datasaksi.create','uses'=>'monitoring\DataSaksiController@create']);
		Route::get('/monitoring/datasaksi/show/{id}',['as'=>'monitoring.datasaksi.show','uses'=>'monitoring\DataSaksiController@show']);
		Route::get('/monitoring/datasaksi/edit/{id}',['as'=>'monitoring.datasaksi.edit','uses'=>'monitoring\DataSaksiController@edit']);
		Route::patch('/monitoring/datasaksi/update/{id}',['as'=>'monitoring.datasaksi.update','uses'=>'monitoring\DataSaksiController@update']);
		Route::post('/monitoring/datasaksi/store',['as'=>'monitoring.datasaksi.store','uses'=>'monitoring\DataSaksiController@store']);
		Route::get('/monitoring/datasaksi/{id}',['as'=>'monitoring.datasaksi.delete','uses'=>'monitoring\DataSaksiController@destroy']);

		//Route for Monitoring SubMenu Data PJ TPS / Korsak
		Route::get('/monitoring/datapjtps',['as'=>'monitoring.datapjtps','uses'=>'monitoring\DataPJTPSController@index']);
		Route::get('/monitoring/datapjtps/ajax',['as'=>'monitoring.datapjtps.ajax','uses'=>'monitoring\DataPJTPSController@ajax']);

		Route::get('/monitoring/datapjtps/getdatatable', ['as'=>'monitoring.datapjtps.datatable', 'uses' => 'monitoring\DataPJTPSController@get_datatable']);
		Route::get('/monitoring/datapjtps/create',['as'=>'monitoring.datapjtps.create','uses'=>'monitoring\DataPJTPSController@create']);
		Route::get('/monitoring/datapjtps/show/{id}',['as'=>'monitoring.datapjtps.show','uses'=>'monitoring\DataPJTPSController@show']);
		Route::get('/monitoring/datapjtps/edit/{id}',['as'=>'monitoring.datapjtps.edit','uses'=>'monitoring\DataPJTPSController@edit']);
		Route::patch('/monitoring/datapjtps/update/{id}',['as'=>'monitoring.datapjtps.update','uses'=>'monitoring\DataPJTPSController@update']);
		Route::post('/monitoring/datapjtps/store',['as'=>'monitoring.datapjtps.store','uses'=>'monitoring\DataPJTPSController@store']);
		Route::get('/monitoring/datapjtps/{id}',['as'=>'monitoring.datapjtps.delete','uses'=>'monitoring\DataPJTPSController@destroy']);



		//Route for Monitoring Submenu Data Admin Kecamatan
		Route::get('/monitoring/dataadminkecamatan',['as'=>'monitoring.dataadminkecamatan','uses'=>'monitoring\DataAdminKecamatanController@index']);
		Route::get('/monitoring/dataadminkecamatan/ajax',['as'=>'monitoring.dataadminkecamatan.ajax','uses'=>'monitoring\DataAdminKecamatanController@ajax']);
		Route::get('/monitoring/dataadminkecamatan/getdatatable', ['as'=>'monitoring.dataadminkecamatan.datatable', 'uses' => 'monitoring\DataAdminKecamatanController@get_datatable']);
		Route::get('/monitoring/dataadminkecamatan/create',['as'=>'monitoring.dataadminkecamatan.create','uses'=>'monitoring\DataAdminKecamatanController@create']);
		Route::get('/monitoring/dataadminkecamatan/show/{id}',['as'=>'monitoring.dataadminkecamatan.show','uses'=>'monitoring\DataAdminKecamatanController@show']);
		Route::get('/monitoring/dataadminkecamatan/edit/{id}',['as'=>'monitoring.dataadminkecamatan.edit','uses'=>'monitoring\DataAdminKecamatanController@edit']);
		Route::patch('/monitoring/dataadminkecamatan/update/{id}',['as'=>'monitoring.dataadminkecamatan.update','uses'=>'monitoring\DataAdminKecamatanController@update']);
		Route::post('/monitoring/dataadminkecamatan/store',['as'=>'monitoring.dataadminkecamatan.store','uses'=>'monitoring\DataAdminKecamatanController@store']);
		Route::get('/monitoring/dataadminkecamatan/{id}',['as'=>'monitoring.dataadminkecamatan.delete','uses'=>'monitoring\DataAdminKecamatanController@destroy']);


		//Route for Monitoring Submenu Data Admin Kota/Kabupaten 
		Route::get('/monitoring/dataadminkota',['as'=>'monitoring.dataadminkota','uses'=>'monitoring\DataAdminKotaController@index']);
		Route::get('/monitoring/dataadminkota/ajax',['as'=>'monitoring.dataadminkota.ajax','uses'=>'monitoring\DataAdminKotaController@ajax']);
		Route::get('/monitoring/dataadminkota/getdatatable', ['as'=>'monitoring.dataadminkota.datatable', 'uses' => 'monitoring\DataAdminKotaController@get_datatable']);
		Route::get('/monitoring/dataadminkota/create',['as'=>'monitoring.dataadminkota.create','uses'=>'monitoring\DataAdminKotaController@create']);
		Route::get('/monitoring/dataadminkota/show/{id}',['as'=>'monitoring.dataadminkota.show','uses'=>'monitoring\DataAdminKotaController@show']);
		Route::get('/monitoring/dataadminkota/edit/{id}',['as'=>'monitoring.dataadminkota.edit','uses'=>'monitoring\DataAdminKotaController@edit']);
		Route::patch('/monitoring/dataadminkota/update/{id}',['as'=>'monitoring.dataadminkota.update','uses'=>'monitoring\DataAdminKotaController@update']);
		Route::post('/monitoring/dataadminkota/store',['as'=>'monitoring.dataadminkota.store','uses'=>'monitoring\DataAdminKotaController@store']);
		Route::get('/monitoring/dataadminkota/{id}',['as'=>'monitoring.dataadminkota.delete','uses'=>'monitoring\DataAdminKotaController@destroy']);

		//Route for Monitoring Submenu Data Admin Provinsi
		Route::get('/monitoring/dataadminprovinsi',['as'=>'monitoring.dataadminprovinsi','uses'=>'monitoring\DataAdminProvinsiController@index']);
		Route::get('/monitoring/dataadminprovinsi/ajax',['as'=>'monitoring.dataadminprovinsi.ajax','uses'=>'monitoring\DataAdminProvinsiController@ajax']);
		Route::get('/monitoring/dataadminprovinsi/getdatatable', ['as'=>'monitoring.dataadminprovinsi.datatable', 'uses' => 'monitoring\DataAdminProvinsiController@get_datatable']);
		Route::get('/monitoring/dataadminprovinsi/create',['as'=>'monitoring.dataadminprovinsi.create','uses'=>'monitoring\DataAdminProvinsiController@create']);
		Route::get('/monitoring/dataadminprovinsi/show/{id}',['as'=>'monitoring.dataadminprovinsi.show','uses'=>'monitoring\DataAdminProvinsiController@show']);
		Route::get('/monitoring/dataadminprovinsi/edit/{id}',['as'=>'monitoring.dataadminprovinsi.edit','uses'=>'monitoring\DataAdminProvinsiController@edit']);
		Route::patch('/monitoring/dataadminprovinsi/update/{id}',['as'=>'monitoring.dataadminprovinsi.update','uses'=>'monitoring\DataAdminProvinsiController@update']);
		Route::post('/monitoring/dataadminprovinsi/store',['as'=>'monitoring.dataadminprovinsi.store','uses'=>'monitoring\DataAdminProvinsiController@store']);
		Route::get('/monitoring/dataadminprovinsi/{id}',['as'=>'monitoring.dataadminprovinsi.delete','uses'=>'monitoring\DataAdminProvinsiController@destroy']); 

		//Route for Monitoring Submenu Data Admin Event
		Route::get('/monitoring/dataadminevent',['as'=>'monitoring.dataadminevent','uses'=>'monitoring\DataAdminEventController@index']);
		Route::get('/monitoring/dataadminevent/ajax',['as'=>'monitoring.dataadminevent.ajax','uses'=>'monitoring\DataAdminEventController@ajax']);
		Route::get('/monitoring/dataadminevent/getdatatable', ['as'=>'monitoring.dataadminevent.datatable', 'uses' => 'monitoring\DataAdminKotaController@get_datatable']);
		Route::get('/monitoring/dataadminevent/create',['as'=>'monitoring.dataadminevent.create','uses'=>'monitoring\DataAdminEventController@create']);
		Route::get('/monitoring/dataadminevent/show/{id}',['as'=>'monitoring.dataadminevent.show','uses'=>'monitoring\DataAdminEventController@show']);
		Route::get('/monitoring/dataadminevent/edit/{id}',['as'=>'monitoring.dataadminevent.edit','uses'=>'monitoring\DataAdminEventController@edit']);
		Route::patch('/monitoring/dataadminevent/update/{id}',['as'=>'monitoring.dataadminevent.update','uses'=>'monitoring\DataAdminEventController@update']);
		Route::post('/monitoring/dataadminevent/store',['as'=>'monitoring.dataadminevent.store','uses'=>'monitoring\DataAdminEventController@store']);
		Route::get('/monitoring/dataadminevent/{id}',['as'=>'monitoring.dataadminevent.delete','uses'=>'monitoring\DataAdminEventController@destroy']); 


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

	//End Route For Menu MONITORING

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

	// Absensi For Saksi
	Route::get('/absensi/saksi/{id}', ['as' => 'absensi.saksi.show', 'uses' => 'AbsensiController@showSaksi']);
	Route::post('/absensi/saksi', ['as' => 'absensi.saksi.create', 'uses' => 'AbsensiController@createAbsen']);
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
	
		//Route for TPS
		Route::get('/datamaster/TPS',['as'=>'datamaster.TPS.index', 'uses'=>'data_master\TPSController@index']);
		Route::get('/datamaster/TPS/ajax',['as'=>'datamaster.TPS.ajax', 'uses'=>'data_master\TPSController@ajax']);
		Route::get('/datamaster/TPS/getdatatable',['as'=>'datamaster.TPS.datatable', 'uses'=>'data_master\TPSController@get_datatable']);
		Route::get('/datamaster/TPS/create',['as'=>'datamaster.TPS.create', 'uses'=>'data_master\TPSController@create']);
		Route::get('/datamaster/TPS/edit/{id}',['as'=>'datamaster.TPS.edit', 'uses'=>'data_master\TPSController@edit']);
		Route::patch('/datamaster/TPS/update/{id}',['as'=>'datamaster.TPS.update', 'uses'=>'data_master\TPSController@update']);
		Route::post('/datamaster/TPS/store',['as'=>'datamaster.TPS.store', 'uses'=>'data_master\TPSController@store']);
		Route::get('/datamaster/TPS/show/{id}',['as'=>'datamaster.TPS.show', 'uses'=>'data_master\TPSController@show']);
		Route::get('/datamaster/TPS/{id}',['as'=>'datamaster.TPS.delete', 'uses'=>'data_master\TPSController@destroy']);
		//EndRoute for TPS

		//Route for Dapil
		Route::get('/datamaster/dapil',['as'=>'datamaster.dapil.index', 'uses'=>'data_master\DapilController@index']);
		Route::get('/datamaster/dapil/ajax',['as'=>'datamaster.dapil.ajax', 'uses'=>'data_master\DapilController@ajax']);
		Route::get('/datamaster/dapil/getdatatable',['as'=>'datamaster.dapil.datatable', 'uses'=>'data_master\DapilController@get_datatable']);
		Route::get('/datamaster/dapil/create',['as'=>'datamaster.dapil.create', 'uses'=>'data_master\DapilController@create']);
		Route::get('/datamaster/dapil/edit/{id}',['as'=>'datamaster.dapil.edit', 'uses'=>'data_master\DapilController@edit']);
		Route::patch('/datamaster/dapil/update/{id}',['as'=>'datamaster.dapil.update', 'uses'=>'data_master\DapilController@update']);
		Route::post('/datamaster/dapil/store',['as'=>'datamaster.dapil.store', 'uses'=>'data_master\DapilController@store']);
		Route::get('/datamaster/dapil/show/{id}',['as'=>'datamaster.dapil.show', 'uses'=>'data_master\DapilController@show']);
		Route::get('/datamaster/dapil/{id}',['as'=>'datamaster.dapil.delete', 'uses'=>'data_master\DapilController@destroy']);
		//EndRoute for Dapil

		//Route for Calon
		Route::get('/datamaster/calon', ['as'=>'datamaster.calon.index', 'uses'=>'data_master\CalonController@index']);
		Route::get('/datamaster/calon/ajax', ['as'=>'datamaster.calon.ajax', 'uses'=>'data_master\CalonController@ajax']);
		Route::get('/datamaster/calon/getdatatable', ['as'=>'datamaster.calon.datatable', 'uses'=>'data_master\CalonController@get_datatable']);
		Route::get('/datamaster/calon/create',['as'=>'datamaster.calon.create', 'uses'=>'data_master\CalonController@create']);
		Route::get('/datamaster/calon/edit/{id}',['as'=>'datamaster.calon.edit', 'uses'=>'data_master\CalonController@edit']);
		Route::patch('/datamaster/calon/update/{id}',['as'=>'datamaster.calon.update', 'uses'=>'data_master\CalonController@update']);
		Route::post('/datamaster/calon/store',['as'=>'datamaster.calon.store', 'uses'=>'data_master\CalonController@store']);
		Route::get('/datamaster/calon/show/{id}',['as'=>'datamaster.calon.show','uses'=>'data_master\CalonController@show']);
		Route::get('/datamaster/calon/{id}',['as'=>'datamaster.calon.delete', 'uses'=>'data_master\CalonController@destroy']);
		//EndRoute for Calon

		//Route for Partai
		Route::get('/datamaster/partai',['as'=>'datamaster.partai.index', 'uses'=>'data_master\PartaiController@index']);
		Route::get('/datamaster/partai/ajax',['as'=>'datamaster.partai.ajax', 'uses'=>'data_master\PartaiController@ajax']);
		Route::get('/datamaster/partai/getdatatable',['as'=>'datamaster.partai.datatable', 'uses'=>'data_master\PartaiController@get_datatable']);
		Route::get('/datamaster/partai/create',['as'=>'datamaster.partai.create', 'uses'=>'data_master\PartaiController@create']);
		Route::get('/datamaster/partai/edit/{id}',['as'=>'datamaster.partai.edit', 'uses'=>'data_master\PartaiController@edit']);
		Route::patch('/datamaster/partai/update/{id}',['as'=>'datamaster.partai.update', 'uses'=>'data_master\PartaiController@edit']);
		Route::post('/datamaster/partai/store',['as'=>'datamaster.partai.store', 'uses'=>'data_master\PartaiController@store']);
		Route::get('/datamaster/partai/show/{id}',['as'=>'datamaster.partai.show','uses'=>'data_master\PartaiController@show']);
		Route::get('/datamaster/partai/{id}',['as'=>'datamaster.partai.delete', 'uses'=>'data_master\PartaiController@destroy']);
		//EndRoute for Partai


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






