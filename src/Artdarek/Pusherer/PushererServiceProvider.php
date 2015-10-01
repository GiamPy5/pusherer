<?php

namespace Artdarek\Pusherer;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use \Config;
use \Pusher;

class PushererServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('artdarek/pusherer');
	}

	/**
	 * Register the service provider.
	 *
	 * @return Pusher $pusher
	 */
	public function register()
	{
	    // Register 'pusherer' instance container to our 'Pusherer' object.
		$this->app['pusherer'] = $this->app->share(function($app)
		{
			return new Pusherer;
		});

	    // Shortcut so developers don't need to add an Alias in app/config/app.php.
	    $this->app->booting(function()
	    {
	        $loader = AliasLoader::getInstance();
	        $loader->alias('Pusherer', 'Artdarek\Pusherer\Facades\Pusherer');
	    });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return ['pusherer'];
	}

}



