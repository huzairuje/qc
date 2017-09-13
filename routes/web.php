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

Auth::routes();
// Route::post('/register', 'RegisterController@register');
// Route::post('/login', 'LoginController@login');
// Route::post('/logout', 'LoginController@logout');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user', 'UserController@getAuthUser');
});

Route::group(['middleware' => 'auth'], function () {
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
	Route::delete('/tabulasi/{id}',['as'=>'tabulasi.delete','uses'=>'TabulasiController@destroy']);

	

	//Route for download
	Route::get('/download',['as'=>'download','uses'=>'DownloadController@index']);

	//Route for Approval
	Route::get('/approval',['as'=>'approval.index','uses'=>'ApprovalController@index']);
	Route::get('/approval/create',['as'=>'approval.create','uses'=>'ApprovalController@create']);


	//Route For Menu MONITORING----------------------- 	
	
		//Route for Monitoring SubMenu DataSaksi
		Route::get('/monitoring/datasaksi',['as'=>'monitoring.datasaksi','uses'=>'monitoring\DataSaksiController@index']);
		


		//Route for Monitoring SubMenu Data PJ TPS
		Route::get('/monitoring/datapjtps',['as'=>'monitoring.datapjtps','uses'=>'monitoring\DataPJTPSController@index']);



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

	//End Route For Menu MONITORING-----------------------



	//Route for data master
	Route::get('/datamaster',['as'=>'data_master.index','uses'=>'DataMasterController@index']);
	Route::get('/datamaster/create',['as'=>'data_master.create','uses'=>'DataMasterController@create']);

});
