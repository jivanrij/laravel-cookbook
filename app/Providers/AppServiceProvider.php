<?php

namespace App\Providers;

use App\Facades\QueryMonitorFacade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        QueryMonitorFacade::injectListener();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        QueryMonitorFacade::startListening();
    }
}
