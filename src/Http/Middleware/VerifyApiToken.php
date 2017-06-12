<?php

namespace ElfSundae\Laravel\Api\Http\Middleware;

use Closure;
use ElfSundae\Laravel\Api\Token;

class VerifyApiToken
{
    /**
     * The Token instance.
     *
     * @var \ElfSundae\Laravel\Api\Token
     */
    protected $token;

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
     */
    public function handle($request, Closure $next)
    {
        if ($this->verifyToken($request)) {
            $request->attributes->set('current_app_key', $this->getKey($request));

            return $next($request);
        }

        return response('Forbidden Request', 403);
    }

    /**
     * Verify the api token from request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function verifyToken($request)
    {
        if ($time = $this->getTime($request)) {
            $verifyTime = abs(time() - $time) < (int) config('api.token_duration');
            $verifyToken = $this->token->verify($this->getToken($request), $this->getKey($request), $time);

            return $verifyTime && $verifyToken;
        }

        return false;
    }

    /**
     * Get the app key.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function getKey($request)
    {
        return $request->input('_key') ?: $request->header('X-API-KEY');
    }

    /**
     * Get the time.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return int
     */
    protected function getTime($request)
    {
        return (int) ($request->input('_time') ?: $request->header('X-API-TIME'));
    }

    /**
     * Get the api token.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected function getToken($request)
    {
        return $request->input('_token') ?: $request->header('X-API-TOKEN');
    }
}
