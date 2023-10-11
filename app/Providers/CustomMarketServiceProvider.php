<?php

namespace App\Providers;

use App\Services\CustomMarketService\CustomMarketService;
use Illuminate\Support\ServiceProvider;

class CustomMarketServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\CustomMarketService\ICustomMarketService', function (){
            return new CustomMarketService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    public function provides()
    {
        return ['App\Services\CustomMarketService\ICustomMarketService'];
    }
}
