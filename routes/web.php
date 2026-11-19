<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/brands', 'BrandController@index');
$router->get('/brands/{brandId}', 'BrandController@show');

$router->get('/clothes', 'ClothesController@index');
$router->get('/clothes/{clothesId}', 'ClothesController@show');

$router->group(['middleware' => 'basic.auth'], function () use ($router) {
    $router->post('/brands', 'BrandController@store');
    $router->put('/brands/{brandId}', 'BrandController@update');
    $router->delete('/brands/{brandId}', 'BrandController@destroy');

    $router->post('/clothes', 'ClothesController@store');
    $router->put('/clothes/{clothesId}', 'ClothesController@update');
    $router->delete('/clothes/{clothesId}', 'ClothesController@destroy');
});