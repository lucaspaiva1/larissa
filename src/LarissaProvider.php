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
		var_dump("testing");
	}

	/**
	* Register any application services.
	*
	* @return void
	*/
	public function register()
	{
	//
	}
}