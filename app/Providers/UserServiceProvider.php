<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService\UserService;

class UserServiceProvider extends ServiceProvider
{
	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('App\Services\UserService\IUserService', function(){
			return new UserService();
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
		return ['App\Services\UserService\IUserService'];
	}
	
}
