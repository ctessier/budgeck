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
        'as' => 'accounts.postSave',
        'uses' => 'AccountController@postSave'
    ])->where('id', '[0-9]+');
    Route::get('{id}/year/{year}/month/{month}', [
        'as' => 'accounts.month',
        'uses' => 'AccountController@getMonth'
    ])->where('id', '[0-9]+')->where('year', '[0-9]{4}')->where('month', '[0-9]{1,2}');
    // Budgets
    Route::get('{account_id}/budgets/edit/{id?}', [
        'as' => 'accounts.budgets.getEdit',
        'uses' => 'AccountBudgetController@getEdit'
    ])->where('account_id', '[0-9]+')->where('id', '[0-9]+');
    Route::post('{account_id}/budgets/save/{id?}', [
        'as' => 'accounts.budgets.postSave',
        'uses' => 'AccountBudgetController@postSave'
    ])->where('account_id', '[0-9]+')->where('id', '[0-9]+');
    
    // Incomes
    Route::get('{account_id}/incomes/edit/{id?}', [
        'as' => 'accounts.incomes.getEdit',
        'uses' => 'AccountIncomeController@getEdit'
    ])->where('account_id', '[0-9]+')->where('id', '[0-9]+');
    Route::post('{account_id}/incomes/save/{id?}', [
        'as' => 'accounts.incomes.postSave',
        'uses' => 'AccountIncomeController@postSave'
    ])->where('account_id', '[0-9]+')->where('id', '[0-9]+');
});