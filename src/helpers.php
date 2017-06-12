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
