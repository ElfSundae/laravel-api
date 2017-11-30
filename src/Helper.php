<?php

namespace ElfSundae\Laravel\Api;

use Closure;
use Illuminate\Support\Str;
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
     * @param  string  $key
     * @param  \Illuminate\Http\Request|null  $request
     * @return \Illuminate\Http\Request
     */
    public static function setCurrentAppKeyForRequest($key, Request $request = null)
    {
        $request = $request ?: app('request');

        $request->attributes->set(static::CURRENT_APP_KEY, $key);

        return $request;
    }

    /**
     * Get the app key of the current api client.
     *
     * @param  \Illuminate\Http\Request|null  $request
     * @return string|null
     */
    public static function getCurrentAppKey(Request $request = null)
    {
        $request = $request ?: app('request');

        return $request->attributes->get(static::CURRENT_APP_KEY);
    }

    /**
     * Add JSON type to the "Accept" header for the request.
     *
     * @see https://laravel-china.org/topics/3430
     *
     * @param  \Closure  $determination
     * @param  \Closure  $callback
     * @return mixed
     */
    public static function addAcceptableJsonTypeForRequest(Closure $determination = null, Closure $callback = null)
    {
        app()->rebinding('request', function ($app, $request) use ($determination, $callback) {
            if (is_null($determination) || $determination($request)) {
                $accept = $request->headers->get('Accept');

                if (! Str::contains($accept, ['/json', '+json'])) {
                    $accept = rtrim('application/json,'.$accept, ',');

                    $request->headers->set('Accept', $accept);
                    $request->server->set('HTTP_ACCEPT', $accept);
                    $_SERVER['HTTP_ACCEPT'] = $accept;

                    if ($callback) {
                        $callback($request);
                    }
                }
            }
        });
    }
}
