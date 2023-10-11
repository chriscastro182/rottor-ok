<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ModelService\ModelService;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind('App\Services\ModelService\IModelService', function(){
			return new ModelService();
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
		return ['App\Services\ModelService\IModelService'];
	}
}
