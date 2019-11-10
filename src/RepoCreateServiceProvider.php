<?php

namespace GustavoRF\RepoCreate;

use GustavoRF\RepoCreate\Console\RepoCreateCommand;
use GustavoRF\RepoCreate\Console\ServiceCreateCommand;

use Illuminate\Support\ServiceProvider;

class RepoCreateServiceProvider extends ServiceProvider
{
	public function boot()
	{
		if ($this->app->runningInConsole()) {
			$this->commands([
				RepoCreateCommand::class,
				ServiceCreateCommand::class,
			]);
		}
	}

	public function register()
	{
		# code...
	}
}