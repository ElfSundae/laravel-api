<?php

namespace ElfSundae\Laravel\Api;

use Illuminate\Http\Request;

class Helper
{
    /**
     * Stores the app key of the current api client.
     */
    const CURRENT_APP_KEY = 'current_app_key';

    /**
     * Set the current app key for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $key
     * @return \Illuminate\Http\Request
     */
    public static function setCurrentAppKeyForRequest(Request $request, $key)
    {
        $request->attributes->set(static::CURRENT_APP_KEY, $key);

        return $request;
    }

    /**
     * Get the app key of the current api client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public static function getCurrentAppKey(Request $request)
    {
        return $request->attributes->get(static::CURRENT_APP_KEY);
    }
}
