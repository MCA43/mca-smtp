<?php

namespace Mca\Smtp\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Mca\Smtp\Support\McaSmtpLocale;
use Symfony\Component\HttpFoundation\Response;

class SetMcaSmtpLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        McaSmtpLocale::apply();

        return $next($request);
    }
}
