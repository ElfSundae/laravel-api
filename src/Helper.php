<?php

namespace ElfSundae\Laravel\Api;

use Illuminate\Http\Request;

class Helper
{
    /**
     * Stores the app key of current api client.
     */
    const CURRENT_APP_KEY = 'current_app_key';

    /**
     * Set current app key for the request.
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
     * Get the app key of current api client.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public static function getCurrentAppKey(Request $request)
    {
        return $request->attributes->get(static::CURRENT_APP_KEY);
    }

    /**
     * Generate data of api token for HTTP headers.
     *
     * @param  string  $appKey
     * @param  string|int|null  $time
     * @return array
     */
    public static function generateApiTokenForHttpHeaders($appKey, $time = null)
    {
        $headers = [];

        if ($data = app(Token::class)->generateDataForKey($appKey, $time)) {
            foreach ($data as $key => $value) {
                $headers['X-API-'.strtoupper($key)] = $value;
            }
        }

        return $headers;
    }

    /**
     * Generate data of api token for URL query.
     *
     * @param  string  $appKey
     * @param  string|int|null  $time
     * @return array
     */
    public static function generateApiTokenForUrlQuery($appKey, $time = null)
    {
        $query = [];

        if ($data = app(Token::class)->generateDataForKey($appKey, $time)) {
            foreach ($data as $key => $value) {
                $query['_'.$key] = $value;
            }
        }

        return $query;
    }

    /**
     * Generate data of api token for URL query string.
     *
     * @param  string  $appKey
     * @param  string|int|null  $time
     * @return string
     */
    public static function generateApiTokenForUrlQueryString($appKey, $time = null)
    {
        return http_build_query(static::generateApiTokenForUrlQuery($appKey, $time));
    }
}
