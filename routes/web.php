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

$router->post('register', 'LoginController@register');

$router->post('login', 'LoginController@login');

$router->get('item-list', 'ItemController@index');
$router->post('item-create', 'ItemController@create');
$router->put('item-update/{_id}', 'ItemController@update');
$router->delete('item-delete/{_id}', 'ItemController@destroy');

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});
