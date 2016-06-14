<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index')->name('home');

Route::get('/article/{url}', 'ArticleController@show')->name('article');

//
Route::group(['prefix' => '/auth'], function () {
    Route::get('/', 'AuthController@show')->name('login');
    Route::post('login', 'AuthController@login')->name('login.action');
    Route::any('logout', 'AuthController@logout')->name('logout');
});
