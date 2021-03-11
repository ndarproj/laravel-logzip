<?php

namespace Ndarproj\Logzip;

use Illuminate\Support\ServiceProvider;

class LogzipServiceProvider extends ServiceProvider
{
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../config/logzip.php' => config_path('logzip.php'),
		], 'config');

		if ($this->app->runningInConsole()) {
			$this->commands([
				Commands\Logzip::class,
			]);
		}
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/../config/logzip.php', 'logzip');
	}
}
