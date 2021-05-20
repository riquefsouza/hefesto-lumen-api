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

/*
$router->get('/', function () use ($router) {
    return $router->app->version();
});
*/

$router->group(['prefix' => '/api/v1'], function () use ($router) {

    $router->post('admParameterCategory', 'AdmParameterCategoryController@store');
    $router->get('admParameterCategory', 'AdmParameterCategoryController@index');
    $router->get('admParameterCategory/{id}', 'AdmParameterCategoryController@show');
    $router->put('admParameterCategory/{id}', 'AdmParameterCategoryController@update');
    $router->delete('admParameterCategory/{id}', 'AdmParameterCategoryController@destroy');

    $router->post('admParameter', 'AdmParameterController@store');
    $router->get('admParameter', 'AdmParameterController@index');
    $router->get('admParameter/{id}', 'AdmParameterController@show');
    $router->put('admParameter/{id}', 'AdmParameterController@update');
    $router->delete('admParameter/{id}', 'AdmParameterController@destroy');

    $router->post('admPage', 'AdmPageController@store');
    $router->get('admPage', 'AdmPageController@index');
    $router->get('admPage/{id}', 'AdmPageController@show');
    $router->put('admPage/{id}', 'AdmPageController@update');
    $router->delete('admPage/{id}', 'AdmPageController@destroy');

});
