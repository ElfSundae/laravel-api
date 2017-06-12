<?php

namespace ElfSundae\Laravel\Api\Console\Commands;

use Illuminate\Console\Command;

class GenerateClient extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:client {app name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate key and secret for an api client.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $client = $this->laravel->make('api.client');

        $data = [
            'name' => $name = $this->argument('app name'),
            'key' => $key = $client->appKeyForName($name),
            'secret' => $client->generateAppSecretForKey($key),
        ];

        $this->table(array_keys($data), [array_values($data)]);
    }
}
