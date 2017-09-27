<?php

namespace ElfSundae\Laravel\Api;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Container\Container;

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

    /**
     * Add JSON type to the "Accept" header for the request.
     *
     * @see https://laravel-china.org/topics/3430
     *
     * @param  \Illuminate\Container\Container  $app
     * @param  callable  $determination  ($request) :bool
     * @param  callable  $callback  ($request)
     * @return mixed
     */
    public static function addAcceptableJsonTypeForRequest(Container $app, $determination = null, $callback = null)
    {
        $app->rebinding('request', function ($app, $request) use ($determination, $callback) {
            if (is_null($determination) || call_user_func($determination, $request)) {
                $accept = $request->headers->get('Accept');

                if (! Str::contains($accept, ['/json', '+json'])) {
                    $accept = rtrim('application/json,'.$accept, ',');

                    $request->headers->set('Accept', $accept);
                    $request->server->set('HTTP_ACCEPT', $accept);
                    $_SERVER['HTTP_ACCEPT'] = $accept;

                    if ($callback) {
                        call_user_func($callback, $request);
                    }
                }
            }
        });
    }
}
