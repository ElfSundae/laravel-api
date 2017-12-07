<?php

namespace ElfSundae\Laravel\Api;

use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;

class ApiServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app instanceof LumenApplication) {
            $this->app->configure('api'); // @codeCoverageIgnore
        }

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
            $client = new Client(
                $app['encrypter'],
                $app['config']->get('api.clients', [])
            );

            $client->setDefaultAppKey($app['config']->get('api.default_client'));

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
            return new Token($app['api.client']);
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
        ], 'laravel-api');

        $this->commands([
            Console\GenerateClientCommand::class,
            Console\GenerateTokenCommand::class,
        ]);
    }
}
