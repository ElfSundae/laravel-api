<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Api Response
    |--------------------------------------------------------------------------
    */

    'response' => [
        'key' => [
            'code' => 'code',
            'message' => 'msg',
        ],
        'code' => [
            'success' => 1,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Api Token Duration
    |--------------------------------------------------------------------------
    |
    | The valid duration before the token expires.
    | You may set a big number in the local environment to facilitate debugging.
    |
    */

    'token_duration' => env('API_TOKEN_DURATION', 150),

    /*
    |--------------------------------------------------------------------------
    | Api Clients
    |--------------------------------------------------------------------------
    |
    | All api clients that can make requests to this app's api.
    | The first one may be this app itself, see `Client::defaultAppKey()`.
    |
    | 'app-key' => [
    |      'name' => 'app-name',
    |      'secret' => 'app-secret',
    |  ],
    |
    */

    'clients' => [
        'app-key' => [
            'name' => 'app-name',
            'secret' => 'app-secret',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default Client
    |--------------------------------------------------------------------------
    |
    | The app key of the default client.
    | By default, it will be the first one in the "clients" array.
    |
    | See `Client::defaultAppKey()`.
    |
    */

    'default_client' => env('API_DEFAULT_CLIENT'),

];
