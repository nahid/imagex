<?php namespace Nahidz\Imagex;

use Illuminate\Support\ServiceProvider;

class ImagexServiceProvider extends ServiceProvider {

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
		$this->package('nahidz/imagex');
		$loader=\Illuminate\Foundation\AliasLoader::getInstance();
		$loader->alias('Imagex', 'Nahidz\Imagex\Facades\Imagex');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['imagex']=$this->app->share(function($app){
			return new Imagex;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('imagex');
	}

}