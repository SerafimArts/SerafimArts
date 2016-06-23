<?php
Route::group(['middleware' => ['analityc']], function() {

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('/article/{url}', 'ArticleController@show')->name('article');
    
});

//
Route::group(['prefix' => '/auth'], function () {
    Route::get('/', 'AuthController@show')->name('login');
    Route::post('login', 'AuthController@login')->name('login.action');
    Route::any('logout', 'AuthController@logout')->name('logout');
});