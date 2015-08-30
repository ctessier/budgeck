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

/**
 * Login
 */
Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', 'Auth\AuthController@postLogin');

/**
 * Needs to be authenticated...
 */
Route::group(['middleware' => 'auth'], function(){

    // Dashboard
    Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
    
    // Profile
    Route::get('profile', ['as' => 'profile', 'uses' => 'ProfileController@index']);
    Route::post('profile/save', [
        'as' => 'profile.save',
        'uses' => 'ProfileController@profileSave'
    ]);
    Route::post('profile/savepassword', [
        'as' => 'profile.savepassword',
        'uses' => 'ProfileController@passwordSave'
    ]);

    // Accounts
    Route::get('accounts', [
        'as' => 'accounts',
        'uses' => 'AccountController@index'
    ]);
    Route::get('accounts/{id}/year/{year}/month/{month}', [
        'as' => 'month', 
        'uses' => 'AccountController@month'
    ]);
    
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
});