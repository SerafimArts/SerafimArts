<?php

Route::get('/', [
    'as'   => 'admin.dashboard',
    'uses' => 'Interfaces\Http\Controllers\AdminController@dashboard',
]);
