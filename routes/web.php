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

Route::get('/', function () {
    return view('welcome');
});

Route::post('/logout', 'Auth\LoginController@logout');

Route::get('login', 'Auth\LoginController@showLoginForm');
Route::post('login', 'Auth\LoginController@login')->name('login');

Route::prefix('admin')->name('admin')->middleware('auth', 'userIsAdmin')->group(function() {

    /**
     * Page loaders
     *
     * (Use plural form for resources)
     */
    Route::get('/', 'Admin\DashboardController@index')->name('.dashboard');

    Route::get('app/users', 'Admin\AppUserController@index')->name('.app.user.index');
    Route::get('app/users/{user_id}', 'Admin\AppUserController@show')->name('.app.user.show');

    Route::get('buildings', 'Admin\BuildingController@index')->name('.building.index');
    Route::get('buildings/create', 'Admin\BuildingController@create')->name('.building.create');
    Route::get('buildings/{building_id}', 'Admin\BuildingController@show')->name('.building.show');
    Route::get('buildings/{building_id}/edit', 'Admin\BuildingController@edit')->name('.building.edit');

    Route::get('categories', 'Admin\CategoryController@index')->name('.category.index');
    Route::get('categories/create', 'Admin\CategoryController@create')->name('.category.create');
    Route::get('categories/{category_id}', 'Admin\CategoryController@show')->name('.category.show');
    Route::get('categories/{category_id}/edit', 'Admin\CategoryController@edit')->name('.category.edit');

    Route::get('conditions', 'Admin\ConditionController@index')->name('.condition.index');
    Route::get('conditions/create', 'Admin\ConditionController@create')->name('.condition.create');
    Route::get('conditions/{condition_id}/edit', 'Admin\ConditionController@edit')->name('.condition.edit');

    Route::get('statuses', 'Admin\StatusController@index')->name('.status.index');
    Route::get('statuses/create', 'Admin\StatusController@create')->name('.status.create');
    Route::get('statuses/{status_id}/edit', 'Admin\StatusController@edit')->name('.status.edit');

    Route::get('recordings', 'Admin\RecordingController@index')->name('.recording.index');
    Route::get('recordings/create', 'Admin\RecordingController@create')->name('.recording.create');
    Route::get('recordings/previousdays', 'Api\RecordingsByDaysController@index');

    /**
     * Ajax handlers
     *
     * (Use singular form for resources)
     */
    Route::post('building', 'Api\BuildingController@store')->name('.building.store');
    Route::put('building/{building_id}', 'Api\BuildingController@update')->name('.building.update');

    Route::post('recording', 'Api\RecordingController@store')->name('.recording.store');
    Route::put('recording/{recording_id}', 'Api\RecordingController@update')->name('.recording.update');

    Route::post('category', 'Api\CategoryController@store')->name('.category.store');
    Route::put('category/{category_id}', 'Api\CategoryController@update')->name('.category.update');

    Route::post('condition', 'Api\ConditionController@store')->name('.condition.store');
    Route::put('condition/{condition_id}', 'Api\ConditionController@update')->name('.condition.update');

    Route::post('status', 'Api\StatusController@store')->name('.status.store');
    Route::put('status/{status_id}', 'Api\StatusController@update')->name('.status.update');

});
