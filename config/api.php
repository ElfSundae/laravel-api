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

    'token_duration' => env('API_TOKEN_DURATION', 180),

    /*
    |--------------------------------------------------------------------------
    | Api Clients
    |--------------------------------------------------------------------------
    |
    | All api clients that can make requests to this app's api.
    | The first one is this app itself, see `Api\ClientManager::defaultAppKey()`.
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

];
