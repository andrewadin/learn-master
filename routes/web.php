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

$router->get('/key', function(){
    return \Illuminate\Support\Str::random(32);
});

$router->group([
    'prefix' => 'api'
], function() use($router){
    $router->post('logout', 'AuthController@logout');
    $router->post('login', 'AuthController@login');
    $router->post('refresh', 'AuthController@refresh');
    $router->post('profile', 'AuthController@logged');
    $router->get('books', 'BookController@showBooks');
});

// $router->get('books', 'BookController@showBooks');
$router->post('books', 'BookController@createBook');
$router->put('books', 'BookController@updateBook');
$router->delete('books', 'BookController@deleteBook');
