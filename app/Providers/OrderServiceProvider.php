<?php

namespace App\Providers;

use App\Services\OrderService\OrderService;
use Illuminate\Support\ServiceProvider;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\OrderService\IOrderService', function (){
            return new OrderService();
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
        return ['App\Services\OrderService\IOrderService'];
    }
}
