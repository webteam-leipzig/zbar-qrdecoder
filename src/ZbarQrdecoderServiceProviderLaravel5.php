<?php namespace RobbieP\ZbarQrdecoder;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ZbarQrdecoderServiceProviderLaravel5 extends ServiceProvider {

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
                $this->publishes([
					__DIR__ . '/../../config/config.php' => config_path('zbar-qrdecoder.php'),
		]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//$this->app['zbardecoder'] = $this->app->share(function($app)
		$this->app->singleton('zbardecoder' ,function($app)
		{
			$config = $app['config']->get('zbar-qrdecoder::config');
			return new ZbarDecoder($config);
		});

		$this->app->booting(function()
		{
			$loader = AliasLoader::getInstance();
			$loader->alias('ZbarDecoder', 'RobbieP\ZbarQrdecoder\Facades\ZbarDecoder');
		});
	}

}
