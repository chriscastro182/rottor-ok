<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MotorService\MotorService;

class MotorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind('App\Services\MotorService\IMotorService', function(){
			return new MotorService();
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

	/**
	 * Provides service
	 *
	 * @return void
	 */
	public function provides()
	{
		return ['App\Services\MotorService\IMotorService'];
	}
}
