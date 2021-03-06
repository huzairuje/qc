<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
	//Route API for Tabulasi
	Route::get('v1/tabulasi', 'API\TabulasiAPIController@index');
	
	// Route::post('v1/tabulasi/create', 'TabulasiController@create');
	// Route::get('v1/tabulasi/show/{id}','TabulasiController@show');	
	
    
Route::get('v1/datasaksi', 'API\MonitoringDataSaksiAPIController@index');
	Route::get('v1/datapjtps', 'API\MonitoringDatapjtpsAPIController@index');