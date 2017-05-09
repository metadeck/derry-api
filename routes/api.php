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
    Route::post('login', 'Api\AuthController@login');
    Route::post('register', 'Api\AuthController@register');

    Route::post('password/reset', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.reset');

    Route::get('buildings', 'Api\BuildingController@index');
    Route::get('buildings/nearby', 'Api\NearbyBuildingsController@index');


//    Route::group( ['middleware' => ['jwt.refresh']], function(){
//        Route::post('refreshtoken', 'Api\AuthController@refreshToken');
//    });

//    Route::group( ['middleware' => ['jwt.auth', 'jwt.refresh']], function ()
//    {
//        Route::get('buildings', 'Api\BuildingController@index');
//    });

});
