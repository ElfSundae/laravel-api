<?php

namespace ElfSundae\Laravel\Api\Console\Commands;

use Illuminate\Console\Command;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:token {app key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate an api token.';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $token = $this->laravel->make('api.token');

        $key = $this->argument('app key');

        if ($data = $token->generateDataForKey($key)) {
            $this->table(array_keys($data), [array_values($data)]);
        } else {
            $this->error('Invalid app key: '.$key);
        }
    }
}
