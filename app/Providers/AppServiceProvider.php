<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('upper', function($input)
        {
            return "<?php echo mb_strtoupper($input); ?>";
        });

        Blade::directive('date', function($input)
        {
            return "<?php echo date_create($input)->format('d-m-Y') ?>";
        });

        Blade::directive('short_date', function($input)
        {
            return "<?php echo date_create($input)->format('d/m') ?>";
        });

        Blade::directive('time', function($input)
        {
            return "<?php if(!is_null($input)) { echo date_create($input)->format('H:i'); } ?>";
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
