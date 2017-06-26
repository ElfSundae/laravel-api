<?php

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
     * Get the app key of the current api client.
     *
     * @see \ElfSundae\Laravel\Api\Middleware\VerifyApiToken
     *
     * @return string|null
     */
    function current_app_key()
    {
        return app('request')->attributes->get('current_app_key');
    }
}
