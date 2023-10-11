<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\MessageService\MessageService;

class MessageServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind('App\Services\MessageService\IMessageService', function(){
			return new MessageService();
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
		return ['App\Services\MessageService\IMessageService'];
	}
}
