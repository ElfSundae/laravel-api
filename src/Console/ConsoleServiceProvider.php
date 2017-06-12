<?php

namespace ElfSundae\Laravel\Api\Console;

use Illuminate\Support\ServiceProvider;

class ConsoleServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        'GenerateClient' => 'command.api.generate.client',
        'GenerateToken' => 'command.api.generate.token',
    ];

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->commands as $key => $value) {
            if (method_exists($this, $method = "register{$key}Command")) {
                call_user_func_array([$this, $method], [$value]);
            } else {
                $this->app->singleton($value, __NAMESPACE__.'\\Commands\\'.$key);
            }
        }

        $this->commands(array_values($this->commands));
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return array_values($this->commands);
    }
}
