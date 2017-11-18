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

Route::get('docs', function(){
    return View::make('docs.api.v1.index');
});

Route::prefix('admin')->name('admin')->middleware('auth', 'userIsAdmin')->group(function() {

    /**
     * Page loaders
     *
     * (Use plural form for resources)
     */
    Route::get('/', 'Admin\DashboardController@index')->name('.dashboard');

    Route::get('users', 'Admin\UserController@index')->name('.user.index');
    Route::get('users/{user_id}', 'Admin\UserController@show')->name('.user.show');

    Route::get('businesses', 'Admin\BusinessController@index')->name('.business.index');
    Route::get('businesses/create', 'Admin\BusinessController@create')->name('.business.create');
    Route::get('businesses/{business_id}', 'Admin\BusinessController@show')->name('.business.show');
    Route::get('businesses/{business_id}/edit', 'Admin\BusinessController@edit')->name('.business.edit');

    Route::get('categories', 'Admin\CategoryController@index')->name('.category.index');
    Route::get('categories/create', 'Admin\CategoryController@create')->name('.category.create');
    Route::get('categories/{category_id}', 'Admin\CategoryController@show')->name('.category.show');
    Route::get('categories/{category_id}/edit', 'Admin\CategoryController@edit')->name('.category.edit');

    /**
     * Ajax handlers
     *
     * (Use singular form for resources)
     */
    Route::post('business', 'Api\BusinessController@store')->name('.business.store');
    Route::put('business/{business_id}', 'Api\BusinessController@update')->name('.business.update');

    Route::post('category', 'Api\CategoryController@store')->name('.category.store');
    Route::put('category/{category_id}', 'Api\CategoryController@update')->name('.category.update');

});
