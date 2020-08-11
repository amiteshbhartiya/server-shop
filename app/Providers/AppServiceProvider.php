<?php

namespace App\Providers;

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
        $this->app->bind('App\Repositories\Interfaces\ServerDetailRepositoryInterface', function ($app) {
            return new \App\Repositories\ServerDetailRepository;
        });
        
        $this->app->bind('App\Service\Interfaces\ImportServiceInterface', function ($app) {
            return new \App\Service\ImportExcelService;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
