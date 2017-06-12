<?php

namespace ElfSundae\Laravel\Api;

use Illuminate\Support\ServiceProvider;
use ElfSundae\Laravel\Api\Console\ConsoleServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the service provider.
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerClient();

        $this->registerToken();

        if ($this->app->runningInConsole()) {
            $this->registerForConsole();
        }
    }

    /**
     * Register the Client singleton.
     */
    protected function registerClient()
    {
        $this->app->singleton('api.client', function ($app) {
            $config = $app->make('config');

            return new Client(
                    $app->make('encrypter'),
                    $config->get('api.clients', [])
                )
                ->setDefaultAppKey($config->get('api.default_client'));
        });

        $this->app->alias('api.client', Client::class);
    }

    /**
     * Register the Token singleton.
     */
    protected function registerToken()
    {
        $this->app->singleton('api.token', function ($app) {
            return new Token($app->make('api.client'));
        });

        $this->app->alias('api.token', Token::class);
    }

    protected function registerForConsole()
    {
        $this->publishes([
            __DIR__.'/../config/api.php' => config_path('api.php')
        ], 'laravel-api');

        $this->app->register(ConsoleServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['api.client', 'api.token'];
    }
}
