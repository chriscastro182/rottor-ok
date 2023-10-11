<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CustomerService\CustomerService;

class CustomerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind('App\Services\CustomerService\ICustomerService', function(){
			return new CustomerService();
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
		return ['App\Services\CustomerService\ICustomerService'];
	}
}
