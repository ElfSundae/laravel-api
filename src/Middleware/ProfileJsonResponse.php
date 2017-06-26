<?php

namespace ElfSundae\Laravel\Api\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;

class ProfileJsonResponse
{
    /**
     * Handle an incoming request.
     *
     * @see https://github.com/barryvdh/laravel-debugbar/issues/252#issuecomment-248343762
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        if (
            $response instanceof JsonResponse &&
            app()->bound('debugbar') &&
            app('debugbar')->isEnabled() &&
            is_object($response->getData())
        ) {
            $response->setData($response->getData(true) + [
                '_debugbar' => app('debugbar')->getData(),
            ]);
        }

        return $response;
    }
}
