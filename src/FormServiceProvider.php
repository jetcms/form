<?php namespace JetCMS\Form;

use JetCMS\Core\CoreServiceProvider;

class FormServiceProvider extends CoreServiceProvider {

	/**
	 * Define Service Providers from our dependencies
	 */
	protected $parent_providers = [];

	/**
	 * Define aliases to register
	 */
	protected $aliases = [];

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishConfig(__DIR__,'form');

		$this->loadViewsFrom(__DIR__.'/../views', 'jetcms.form');

		$this->publishes([
			__DIR__.'/../publish' => base_path()
		]);

		include __DIR__.'/../routes.php';
	}

}