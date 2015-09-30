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
	protected $defer = true;

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
	    // Register 'pusherer' instance container to our 'Pusherer' object
		$this->app['pusherer'] = $this->app->share(function($app)
		{
			$configurations = Config::get('pusherer::connections');
			$default        = $configurations['default'];

		    // connection credentials loaded from config
	        $app_id      = Config::get('pusherer::app_id');
	        $app_key     = Config::get('pusherer::key');
	        $app_secret  = Config::get('pusherer::secret');
	        $app_host    = Config::get('pusherer::host');
	        $app_port    = Config::get('pusherer::port');
	        $app_debug   = Config::get('pusherer::debug');
	        $app_timeout = Config::get('pusherer::timeout');

            // connect to pusher
            $pusher = new Pusher(
            	$default['key'],
            	$default['app_id'],
            	$default['secret'],
            	$default['debug'],
            	$default['host'],
            	$default['port'],
            	$default['timeout']
            );

        	// return pusher
		    return $pusher;
		});

	    // Shortcut so developers don't need to add an Alias in app/config/app.php
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



