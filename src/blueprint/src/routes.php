<?php
/**
 * @var \Illuminate\Routing\Router $route
 * @var string $authrorizable
 * @var \Serafim\Blueprint\Repositories\BlueprintsRepository $blueprints
 * @var string $injector
 */

$route->pattern('file', '[a-z0-9\./\-]+');


//
$route->group(['middleware' => [$authrorizable]], function () use ($route, $blueprints, $injector) {
    $route->get('/', 'DashboardController@index')->name('bp.home');


    $route->group(['middleware' => [$injector]], function () use ($route, $blueprints) {
        /** @var \Serafim\Blueprint\Blueprints\Metadata $bp */
        foreach ($blueprints as $bp) {
            $namePrefix = 'bp.res.' . $bp->class->route;
            $uri = $bp->class->route;

            $route->get($uri, 'CrudController@index')->name($namePrefix . '.index');
            $route->post($uri, 'CrudController@store')->name($namePrefix . '.store');
            $route->get($uri . '/create', 'CrudController@create')->name($namePrefix . '.create');
            $route->get($uri . '/{resource}', 'CrudController@show')->name($namePrefix . '.show');
            $route->post($uri . '/{resource}', 'CrudController@update')->name($namePrefix . '.update');
            $route->delete($uri . '/{resource}', 'CrudController@destroy')->name($namePrefix . '.destroy');
            $route->get($uri . '/{resource}/edit', 'CrudController@edit')->name($namePrefix . '.edit');
        }
    });
});


$route->get('assets/{file}', 'AssetsController@find')->name('bp.asset');

$route->group(['prefix' => 'auth'], function () use ($route) {
    $route->get('/', 'AuthController@login')->name('bp.auth');
    $route->post('/', 'AuthController@loginAction')->name('bp.auth.action');
});