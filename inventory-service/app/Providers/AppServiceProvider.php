<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\File;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if (File::exists(base_path('routes/api.php'))) {
            require base_path('routes/api.php');
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
