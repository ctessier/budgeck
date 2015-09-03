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

Route::get('/', function(){
    return redirect(route('dashboard')); 
});

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
    Route::get('dashboard', [
        'as' => 'dashboard',
        'uses' => 'DashboardController@index'
    ]);
    
    // Profile
    Route::get('profile', [
        'as' => 'profile',
        'uses' => 'ProfileController@index'
    ]);
    Route::post('profile/save', [
        'as' => 'profile.save',
        'uses' => 'ProfileController@postProfileSave'
    ]);
    Route::post('profile/savepassword', [
        'as' => 'profile.savepassword',
        'uses' => 'ProfileController@postPasswordSave'
    ]);

    // Budgets
    Route::get('accounts/{account_id}/budgets/create', [
        'as' => 'budgets.create',
        'uses' => 'AccountCotroller@getCreate'
    ]);
    
    // Incomes
    Route::get('accounts/{account_id}/incomes/create', [
        'as' => 'incomes.create',
        'uses' => 'AccountCotroller@getCreate'
    ]);
    
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
});

Route::group(['prefix' => 'accounts', 'middleware' => 'auth'], function(){
    Route::get('/', [
        'as' => 'accounts',
        'uses' => 'AccountController@index'
    ]);
    Route::get('{id}', [
        'as' => 'accounts.getAccount',
        'uses' => 'AccountController@getAccount'
    ])->where('id', '[0-9]+');
    Route::any('edit/{id?}', [
        'as' => 'accounts.getEdit',
        'uses' => 'AccountController@getEdit'
    ])->where('id', '[0-9]+');
    Route::post('save/{id?}', [
        'as' => 'accounts.postCreate',
        'uses' => 'AccountController@postCreate'
    ])->where('id', '[0-9]+');
    Route::get('{id}/year/{year}/month/{month}', [
        'as' => 'month', 
        'uses' => 'AccountController@month'
    ]);
});