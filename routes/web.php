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

Route::group(['middleware'=>'guest'],function(){
	Route::get('/',['as'=>'dashboard','uses'=>'DashboardController@index']);
	
	Route::get('/helper',['as'=>'helper','uses'=>'HelperController@index']);
	Route::get('/widget',['as'=>'widget','uses'=>'WidgetController@index']);
	Route::get('/table',['as'=>'table','uses'=>'TableController@index']);
	Route::get('/media',['as'=>'media','uses'=>'MediaController@index']);
	Route::get('/chart',['as'=>'chart','uses'=>'ChartController@index']);



	//Route for Tabulasi
	Route::get('/tabulasi',['as'=>'tabulasi.index','uses'=>'TabulasiController@index']);
	Route::get('/tabulasi/create',['as'=>'tabulasi.create','uses'=>'TabulasiController@create']);

	//Route for download
	Route::get('/download',['as'=>'download','uses'=>'DownloadController@index']);

	//Route for Approval
	Route::get('/approval',['as'=>'approval.index','uses'=>'ApprovalController@index']);
	Route::get('/approval/create',['as'=>'approval.create','uses'=>'ApprovalController@create']);

	//Route for Monitoring
	Route::get('/monitoring',['as'=>'monitoring','uses'=>'MonitoringController@index']);

	//Route for data master
	Route::get('/datamaster',['as'=>'data_master','uses'=>'DataMasterController@index']);

});
