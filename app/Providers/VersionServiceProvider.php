<?php

namespace App\Providers;

use App\Services\VersionService\VersionServcie;
use Illuminate\Support\ServiceProvider;

class VersionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\VersionService\IVersionService', function(){
            return new VersionServcie();
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
        return ['App\Services\VersionService\IVersionService'];
    }


}
