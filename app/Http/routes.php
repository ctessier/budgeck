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

Route::get('/', [
    'as'   => 'home',
    'uses' => 'HomeController@getHome',
]);

// Login routes
Route::get('login', [
    'as'   => 'login',
    'uses' => 'Auth\AuthController@getLogin',
]);
Route::post('login', 'Auth\AuthController@postLogin');

// Reset password
Route::controllers([
    'password' => 'Auth\PasswordController',
]);

// Routes only accessible if authenticated
Route::group(['middleware' => 'auth'], function () {
    Route::get('history', [
        'as'   => 'history',
        'uses' => 'HistoryController@show',
    ]);

    Route::get('monitoring/{year}/{month}', [
        'as'   => 'monitoring',
        'uses' => 'MonitorController@getMonitoring',
    ]);

    Route::post('accounts/{accounts}/default', [
        'as'   => 'accounts.default',
        'uses' => 'DefaultAccountController@update',
    ]);
    Route::get('accounts/{accounts}/change', [
        'as'   => 'accounts.change',
        'uses' => 'AccountController@change',
    ]);
    Route::resource('accounts', 'AccountController', [
        'except' => ['edit'],
    ]);

    Route::resource('accounts.account_budgets', 'AccountBudgetController', [
        'except' => ['index', 'show'],
    ]);

    Route::resource('accounts.budgets', 'BudgetController', [
        'except' => ['index'],
    ]);

    Route::resource('accounts.transactions', 'TransactionController', [
        'except' => ['index', 'show'],
    ]);

    // Group for profile routes
    Route::group(['prefix' => 'profile'], function () {
        // Get edit profile and password form
        Route::get('/', [
            'as'   => 'profile',
            'uses' => 'ProfileController@index',
        ]);
        // Send edit profile form
        Route::put('/', [
            'as'   => 'profile.update',
            'uses' => 'ProfileController@update',
        ]);
        // Send edit password form
        Route::put('password', [
            'as'   => 'profile.password.update',
            'uses' => 'ProfileController@updatePassword',
        ]);
    });

    // Group for JSON API
    Route::group(['prefix' => 'api'], function () {
        // Get list of budgets
        Route::get('budgets', [
            'as'   => 'api.budgets',
            'uses' => 'Api\BudgetApiController@get',
        ]);
    });

    // Logout
    Route::get('logout', [
        'as'   => 'logout',
        'uses' => 'Auth\AuthController@getLogout',
    ]);
});
