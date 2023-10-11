<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\QuotationService\QuotationService;

class QuotationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind('App\Services\QuotationService\IQuotationService', function(){
			return new QuotationService();
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
		return ['App\Services\QuotationService\IQuotationService'];
	}
}
