<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', 'Auth\RegisterController@register');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout');


Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/courses', 'CourseController@index');
    Route::post('/courses', 'CourseController@store');
    Route::delete('/courses/{id}', 'CourseController@delete');
    Route::put('/courses/{id}', 'CourseController@update');
    Route::get('/users', 'UserController@index');
    Route::put('/users/{id}', 'UserController@update');
    Route::post('/users', 'UserController@store');
    Route::delete('/users/{id}', 'UserController@delete');

});
