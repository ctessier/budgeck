<?php

namespace Budgeck\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;

use Budgeck\Models\Account;
use Budgeck\Models\AccountBudget;
use Budgeck\Models\Budget;
use Budgeck\Models\Transaction;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Budgeck\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        // Define route parameters patterns
        $router->pattern('accounts', '[0-9]+');
        $router->pattern('budgets', '[0-9]+');
        $router->pattern('transactions', '[0-9]+');
        $router->pattern('year', '[0-9]{4}');
        $router->pattern('month', '[0-9]{1,2}');

        // Define route model binding for account
        $router->bind('accounts', function ($account_id) {
            if (Auth::check()) {
                return Account::where([
                    'id' => $account_id,
                    'user_id' => Auth::user()->id
                ])
                ->firstOrFail();
            }
        });

        // Define route model binding for a account budget
        $router->bind('account_budgets', function ($account_budget_id, $route) {
            return AccountBudget::where([
                    'id' => $account_budget_id,
                    'account_id' => $route->getParameter('accounts')->id
                ])
                ->firstOrFail();
        });

        // Define route model binding for a budget
        $router->bind('budgets', function ($budget_id, $route) {
            return Budget::where([
                    'id' => $budget_id,
                    'account_id' => $route->getParameter('accounts')->id
                ])
                ->firstOrFail();
        });

        // Define route model binding for a transaction
        $router->bind('transactions', function ($transaction_id, $route) {
            return Transaction::where([
                    'id' => $transaction_id,
                    'account_id' => $route->getParameter('accounts')->id
                ])
                ->firstOrFail();
        });

        parent::boot($router);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
