<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MarketLaunchService\MarketLaunchService;

class MarketLaunchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind('App\Services\MarketLaunchService\IMarketLaunchService', function(){
			return new MarketLaunchService();
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
		return ['App\Services\MarketLaunchService\IMarketLaunchService'];
	}
}
