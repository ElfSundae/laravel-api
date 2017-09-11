<?php

namespace ElfSundae\Laravel\Api;

use ElfSundae\Laravel\Api\Client;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Encryption\Encrypter;

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
                $app->make(Encrypter::class),
                $config->get('api.clients', [])
            );

            $client->setDefaultAppKey($config->get('api.default_client'));

            return $client;
        });

        $this->app->alias('api.client', Client::class);
    }

    /**
     * Register the Token singleton.
     *
     * @return void
     */
    protected function registerToken()
    {
        $this->app->singleton('api.token', function ($app) {
            return new Token($app->make(Client::class));
        });

        $this->app->alias('api.token', Token::class);
    }

    /**
     * Register for console.
     *
     * @return void
     */
    protected function registerForConsole()
    {
        $this->publishes([
            __DIR__.'/../config/api.php' => base_path('config/api.php'),
        ], 'api');

        $this->commands([
            Console\GenerateClientCommand::class,
            Console\GenerateTokenCommand::class,
        ]);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return ['api.client', Client::class, 'api.token', Token::class];
    }
}
