<?php

namespace App\Providers;

use App\Services\AppointmentService\AppointmentService;
use Illuminate\Support\ServiceProvider;

class AppointmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\AppointmentService\IAppointmentService', function(){
            return new AppointmentService();
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
        return ['App\Services\AppointmentService\IAppointmentService'];
    }


}
