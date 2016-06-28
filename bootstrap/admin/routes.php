<?php

Route::get('/', [
    'as'   => 'admin.dashboard',
    'uses' => 'Admin\Controllers\DashboardController@show',
]);
