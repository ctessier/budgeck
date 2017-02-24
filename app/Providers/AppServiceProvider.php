<?php

namespace Budgeck\Providers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Set locale
        if (config('app.locale') === 'fr') {
            setlocale(LC_TIME, 'fr_FR.UTF-8');
            Carbon::setLocale('fr');
        }

        // Provide Blade directive for amounts
        Blade::directive('amount', function ($expression) {
            return "<?php echo number_format(with{$expression}, 2, ',', ' ') . ' &euro;'; ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
