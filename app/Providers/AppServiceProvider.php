<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Airplanes;
use App\Observers\AirplaneObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Airplanes::observe(AirplaneObserver::class);
    }
}
