<?php

Route::get('/', ['as' => 'admin.dashboard', function () {

    return AdminSection::view('asd', 'Dashboard');

}]);
