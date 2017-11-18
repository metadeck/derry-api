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

Route::group(['prefix' => '/v1'], function ()
{
    Route::get('categories', 'Api\CategoryController@index');
    Route::get('businesses', 'Api\BusinessController@index');
    Route::get('businesses/nearby', 'Api\NearbyBusinessController@index');
    Route::get('businesses/categories', 'Api\BusinessByCategoryController@index');
});
