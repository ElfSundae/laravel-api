<?php

namespace ElfSundae\Laravel\Api\Middleware;

use Closure;
use ElfSundae\Laravel\Api\Token;
use ElfSundae\Laravel\Api\Helper;
use ElfSundae\Laravel\Api\Exceptions\InvalidApiTokenException;

class VerifyApiToken
{
    /**
     * The Token instance.
     *
     * @var \ElfSundae\Laravel\Api\Token
     */
    protected $token;

    /**
     * The URIs that should be excluded from token verification.
     *
     * @var array
     */
    protected $except = [];

    /**
     * Create the middleware.
     *
     * @param  \ElfSundae\Laravel\Api\Token  $token
     */
    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \ElfSundae\Laravel\Api\Exceptions\InvalidApiTokenException
     */
    public function handle($request, Closure $next)
    {
        if ($this->inExceptArray($request) || $this->verifyToken($request)) {
            Helper::setCurrentAppKeyForRequest($request, $this->getKeyFromRequest($request));

            return $next($request);
        }

        throw new InvalidApiTokenException;
    }

    /**
     * Determine if the request has a URI that should be passed through verification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function inExceptArray($request)
    {
        foreach ($this->except as $except) {
            if ($except !== '/') {
                $except = trim($except, '/');
            }

            if ($request->is($except)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Verify the api token from request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function verifyToken($request)
    {
        $time = (int) ($request->input('_time') ?: $request->header('X-API-TIME'));
        $token = $request->input('_token') ?: $request->header('X-API-TOKEN');

        return abs(time() - $time) < (int) config('api.token_duration') &&
            $this->token->verify($token, $this->getKeyFromRequest($request), $time);
    }

    /**
     * Get the app key from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function getKeyFromRequest($request)
    {
        return $request->input('_key') ?: $request->header('X-API-KEY');
    }
}
