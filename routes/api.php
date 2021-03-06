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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signup');
  
    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('logout', 'Api\AuthController@logout');
    });
});

Route::group(['prefix' => 'user', 'middleware' => 'auth:api'], function () {
    Route::get('', 'Api\UserController@user');
    Route::get('show/{userId}', 'Api\UserController@show');
    Route::put('', 'Api\UserController@update');
    Route::put('information', 'Api\UserController@updateInformation');
    Route::put('filters', 'Api\UserController@updateFilters');

    Route::get('likes', 'Api\LikeController@likes');
    Route::get('likes/matched', 'Api\LikeController@matched');
    Route::post('likes/{userId}', 'Api\LikeController@store');
});


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('dating', 'Api\SearchController@dating');
});


Route::get('information', 'Api\DictionaryController@information');
Route::get('reasons', 'Api\DictionaryController@reasons');
