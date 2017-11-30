<?php

use ElfSundae\Laravel\Api\Helper;
use ElfSundae\Laravel\Api\ApiResponse;

if (! function_exists('api')) {
    /**
     * Create a new API response.
     *
     * @param  mixed  $data
     * @param  int|null  $code
     * @param  array  $headers
     * @param  int  $options
     * @return \ElfSundae\Laravel\Api\ApiResponse
     */
    function api($data = null, $code = null, $headers = [], $options = 0)
    {
        return new ApiResponse($data, $code, $headers, $options);
    }
}

if (! function_exists('current_app_key')) {
    /**
     * Get the app key of current api client.
     *
     * @see \ElfSundae\Laravel\Api\Middleware\VerifyApiToken
     *
     * @return string|null
     */
    function current_app_key()
    {
        return Helper::getCurrentAppKey();
    }
}
