<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@home');

Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

Route::group(['middleware' => 'auth'], function(){
    Route::get('test', function(){
        return 'test';
    }); 
});