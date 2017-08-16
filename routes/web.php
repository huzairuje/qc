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

Route::group(['middleware' => 'auth'], function () {
	Route::get('/',['as'=>'dashboard','uses'=>'DashboardController@index']);
	
	//Route For user
	Route::get('/users', 'UserController@profile')->name('users.profile');
	Route::patch('/users/{id}', 'UserController@update')->name('users.update');

	//Route for Tabulasi

	Route::get('/tabulasi', ['as'=>'tabulasi.index','uses'=>'TabulasiController@index']);
    Route::get('/tabulasi/getdatatable', ['as' => 'tabulasi.datatable',   'uses' => 'TabulasiController@get_datatable']);
	Route::get('/tabulasi/create',['as'=>'tabulasi.create','uses'=>'TabulasiController@create']);	
	Route::get('/tabulasi/show/{id}',['as'=>'tabulasi.show','uses'=>'TabulasiController@show']);	
	Route::get('/tabulasi/edit/{id}',['as'=>'tabulasi.edit','uses'=>'TabulasiController@edit']);	
	Route::patch('/tabulasi/{id}',['as'=>'tabulasi.update','uses'=>'TabulasiController@update']);	
	Route::post('/tabulasi/store',['as'=>'tabulasi.store','uses'=>'TabulasiController@store']);
	Route::get('/tabulasi/ajax',['as'=>'tabulasi.ajax','uses'=>'TabulasiController@ajax']);
	Route::get('/tabulasi/quickcount',['as'=>'tabulasi.quickcount','uses'=>'TabulasiController@quickCount']);

	

	//Route for download
	Route::get('/download',['as'=>'download','uses'=>'DownloadController@index']);

	//Route for Approval
	Route::get('/approval',['as'=>'approval.index','uses'=>'ApprovalController@index']);
	Route::get('/approval/create',['as'=>'approval.create','uses'=>'ApprovalController@create']);

	//Route for Monitoring
	Route::get('/monitoring/datasaksi',['as'=>'monitoring.datasaksi','uses'=>'MonitoringController@dataSaksi']);
	Route::get('/monitoring/datapjtps',['as'=>'monitoring.datapjtps','uses'=>'MonitoringController@dataPjTps']);
	Route::get('/monitoring/tabulasi',['as'=>'monitoring.tabulasi','uses'=>'MonitoringController@tabulasi']);
	Route::get('/monitoring/foto',['as'=>'monitoring.foto','uses'=>'MonitoringController@foto']);
	Route::get('/monitoring/loginterakhir',['as'=>'monitoring.loginterakhir','uses'=>'MonitoringController@loginTerakhir']);
	Route::get('/monitoring/quickrealcount',['as'=>'monitoring.quickrealcount','uses'=>'MonitoringController@quickRealCount']);
	Route::get('/monitoring/presensipetugas',['as'=>'monitoring.presensipetugas','uses'=>'MonitoringController@presensiPetugas']);
	//Route for data master
	Route::get('/datamaster',['as'=>'data_master.index','uses'=>'DataMasterController@index']);
	Route::get('/datamaster/create',['as'=>'data_master.create','uses'=>'DataMasterController@create']);

});
