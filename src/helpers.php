<?php

use ElfSundae\Laravel\Api\Http\ApiResponse;

if (! function_exists('api')) {
    /**
     * Create a new API response.
     *
     * @return \ElfSundae\Laravel\Api\Http\ApiResponse
     */
    function api(...$args)
    {
        return new ApiResponse(...$args);
    }
}

if (! function_exists('current_app_key')) {
    /**
     * Get the app key of the current api client.
     *
     * @see \ElfSundae\Laravel\Api\Http\Middleware\VerifyApiToken
     *
     * @return string|null
     */
    function current_app_key()
    {
        return app('request')->attributes->get('current_app_key');
    }
}
