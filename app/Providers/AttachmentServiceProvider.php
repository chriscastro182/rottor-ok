<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\AttachmentService\AttachmentService;

class AttachmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
		$this->app->bind('App\Services\AttachmentService\IAttachmentService', function(){
			return new AttachmentService();
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
		return ['App\Services\AttachmentService\IAttachmentService'];
	}
}
