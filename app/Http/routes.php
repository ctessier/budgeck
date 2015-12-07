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

/**
 * Accounts routes
 * Needs to be authenticated...
*/
Route::group(['middleware' => 'auth', 'prefix' => 'accounts'], function(){
    Route::get('/', [
        'as' => 'accounts',
        'uses' => 'AccountController@index'
    ]);
    Route::get('{account_id}', [
        'as' => 'accounts.getAccount',
        'uses' => 'AccountController@getAccount'
    ]);
    Route::any('edit/{account_id?}', [
        'as' => 'accounts.getEdit',
        'uses' => 'AccountController@getEdit'
    ]);
    Route::post('save/{account_id?}', [
        'as' => 'accounts.postSave',
        'uses' => 'AccountController@postSave'
    ]);
    
    // Months supervision
    Route::get('{account_id}/year/{year}/month/{month}', [
        'as' => 'accounts.month',
        'uses' => 'AccountController@getMonth'
    ]);
    // Get and save budgets
    Route::get('{account_id}/year/{year}/month/{month}/budgets/edit/{budget_id?}', [
        'as' => 'budgets.getEdit',
        'uses' => 'BudgetController@getEdit'
    ]);
    Route::post('{account_id}/year/{year}/month/{month}/budgets/save/{budget_id?}', [
        'as' => 'budgets.postSave',
        'uses' => 'BudgetController@postSave'
    ]);
    // Add spending
    Route::get('{account_id}/year/{year}/month/{month}/budgets/{budget_id?}/spendings/edit/{spending_id?}', [
        'as' => 'budgets.spendings.getEdit',
        'uses' => 'SpendingController@getEdit'
    ]);
    Route::post('{account_id}/year/{year}/month/{month}/budgets/{budget_id?}/spendings/edit/{spending_id?}', [
        'as' => 'budgets.spendings.postSave',
        'uses' => 'SpendingController@postSave'
    ]);
    
    // Get and save incomes
    Route::get('{account_id}/year/{year}/month/{month}/incomes/edit/{income_id?}', [
        'as' => 'incomes.getEdit',
        'uses' => 'IncomeController@getEdit'
    ]);
    Route::post('{account_id}/year/{year}/month/{month}/incomes/save/{income_id?}', [
        'as' => 'incomes.postSave',
        'uses' => 'IncomeController@postSave'
    ]);
    
    // Accounts budgets
    Route::get('{account_id}/budgets/edit/{budget_id?}', [
        'as' => 'accounts.budgets.getEdit',
        'uses' => 'AccountBudgetController@getEdit'
    ]);
    Route::post('{account_id}/budgets/save/{budget_id?}', [
        'as' => 'accounts.budgets.postSave',
        'uses' => 'AccountBudgetController@postSave'
    ]);
    
    // Accounts incomes
    Route::get('{account_id}/incomes/edit/{income_id?}', [
        'as' => 'accounts.incomes.getEdit',
        'uses' => 'AccountIncomeController@getEdit'
    ]);
    Route::post('{account_id}/incomes/save/{income_id?}', [
        'as' => 'accounts.incomes.postSave',
        'uses' => 'AccountIncomeController@postSave'
    ]);
});

/**
 * Budgets routes
 * Needs to be authenticated...
*/
Route::group(['middleware' => 'auth', 'prefix' => 'budgets'], function(){
    Route::get('{budget_id}/delete', [
        'as' => 'budgets.delete',
        'uses' => 'BudgetController@delete'
    ]);
});

/**
 * Incomes routes
 * Needs to be authenticated...
*/
Route::group(['middleware' => 'auth', 'prefix' => 'incomes'], function(){
    Route::get('{income_id}/delete', [
        'as' => 'incomes.delete',
        'uses' => 'IncomeController@delete'
    ]);
});
