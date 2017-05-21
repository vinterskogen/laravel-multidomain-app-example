<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class CheckDomainIsAllowed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $requestedDomain = $request::site();
        $allowedDomains = [
            'site-1-foo.com',
            'site-2-bar.com',
            'site-3-baz.com',
        ];

        if (! in_array($requestedDomain, $allowedDomains)) {
            return abort(Response::HTTP_BAD_REQUEST, 'Domain not allowed');
        }

        return $next($request);
    }
}
