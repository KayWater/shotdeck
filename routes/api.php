<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::group(['prefix' => 'v1'], function() {
    
    Route::post('/shot/upload', 'Api\ShotController@upload');

    Route::post('/shots', 'Api\ShotController@store');
    
    Route::get('/shots', 'Api\ShotController@index');

    Route::delete('/shots/{id}', 'Api\ShotController@destroy');

    Route::get('/shots/{id}', 'Api\ShotController@show');

    Route::put('/shots/{id}', 'Api\ShotController@update');
    
});