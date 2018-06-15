<?php
namespace Larissa;
use Illuminate\Support\ServiceProvider;
class LarissaProvider extends ServiceProvider
{
	/**
	* Bootstrap any application services.
	*
	* @return void
	*/
	public function boot()
	{
		if ($this->app->runningInConsole()) {
	        $this->commands([
	            LarissaConsole::class
	        ]);
    	}
	}

	/**
	* Register any application services.
	*
	* @return void
	*/
	public function register()
	{
		
	}
	protected $commands = [
		LarissaConsole::class
	];
}