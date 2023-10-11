<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\FactorService\FactorService;

class FactorServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind('App\Services\FactorService\IFactorService', function(){
			return new FactorService();
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
		return ['App\Services\FactorService\IFactorService'];
	}
}
