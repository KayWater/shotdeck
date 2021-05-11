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

    Route::post('auth/login', 'Api\Auth\LoginController@login');

    Route::get('/properties', 'Api\PropertyController@index');

    Route::get('/properties/query', 'Api\PropertyController@query');

    Route::get('/properties/{id}', 'Api\PropertyController@Show');

    Route::get('/properties/{id}/values', 'Api\PropertyController@getValues');

    Route::get('/property-values', 'Api\PropertyValueController@index');

    Route::get('/property-value/{id}', 'Api\PropertyValueController@show');

    Route::put('/property-value/{id}', 'Api\PropertyValueController@update');

    Route::get('/genres/all', 'Api\GenreController@getGenreAll');

    Route::get('/regions/all', 'Api\RegionController@getRegionAll');

    Route::get('/countries/all', 'Api\CountryController@getCountryAll');

    Route::post('/people/create', 'Api\PersonController@store');

    Route::get('/people/search', 'Api\PersonController@search');

    Route::post('/movies/poster/upload', 'Api\MovieController@uploadPoster');

    Route::post('/movies', 'Api\MovieController@store');

    Route::get('/movies', 'Api\MovieController@index');

    Route::get('/movies/{id}', 'Api\MovieController@show');

    Route::put('/movies/{id}', 'Api\MovieController@update');

    Route::get('/movies/{id}/actors', 'Api\MovieController@getActors');

    /** Administrator Route */
    Route::post('/administrators/auth/login', 'Api\Admin\Auth\LoginController@login');


    
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function() {
    Route::get('/users/current', 'Api\UserController@getCurrentUser');
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:admin'], function() {

    Route::get('/administrators/current', 'Api\Admin\UserController@getCurrentUser');

    Route::post('/administrators/auth/logout', 'Api\Admin\Auth\LoginController@logout');

    Route::post('/properties', 'Api\PropertyController@store');

    Route::put('/properties/{id}', 'Api\PropertyController@update');

    Route::post('/properties/{id}/values', 'Api\PropertyValueController@store');
    
});
