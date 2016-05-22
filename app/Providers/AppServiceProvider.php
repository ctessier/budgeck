<?php

namespace Budgeck\Providers;

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
        // Set locale for Carbon
        setlocale(LC_TIME, "fr_FR.UTF-8");
        \Carbon\Carbon::setLocale('fr');

        // Provide Blade directive for figures
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
