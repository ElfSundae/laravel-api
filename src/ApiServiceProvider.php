<?php

namespace ElfSundae\Laravel\Api;

use Illuminate\Support\ServiceProvider;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/api.php', 'api');

        $this->registerClient();

        $this->registerToken();

        if ($this->app->runningInConsole()) {
            $this->registerForConsole();
        }
    }

    /**
     * Register the Client singleton.
     *
     * @return void
     */
    protected function registerClient()
    {
        $this->app->singleton('api.client', function ($app) {
            $config = $app->make('config');

            $client = new Client(
                $app->make('encrypter'),
                $config->get('api.clients', [])
            );

            $client->setDefaultAppKey($config->get('api.default_client'));

            return $client;
        });

        $this->app->alias('api.client', Client::class);

        $this->aliasFacade('ApiClient', Facades\ApiClient::class);
    }

    /**
     * Register the Token singleton.
     *
     * @return void
     */
    protected function registerToken()
    {
        $this->app->singleton('api.token', function ($app) {
            return new Token($app->make('api.client'));
        });

        $this->app->alias('api.token', Token::class);

        $this->aliasFacade('ApiToken', Facades\ApiToken::class);
    }

    /**
     * Register for console.
     *
     * @return void
     */
    protected function registerForConsole()
    {
        $this->publishes([
            __DIR__.'/../config/api.php' => config_path('api.php'),
        ], 'laravel-api');

        $this->commands([
            Commands\GenerateClient::class,
            Commands\GenerateToken::class,
        ]);
    }

    /**
     * Create alias for the facade.
     *
     * @param  string  $facade
     * @param  string  $class
     * @return void
     */
    protected function aliasFacade($facade, $class)
    {
        if (class_exists('Illuminate\Foundation\AliasLoader')) {
            \Illuminate\Foundation\AliasLoader::getInstance()->alias($facade, $class);
        } else {
            class_alias($class, $facade);
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['api.client', 'api.token'];
    }
}
