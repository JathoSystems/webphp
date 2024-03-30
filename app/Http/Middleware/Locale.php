<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Start session if not started
        if (!$request->session()->isStarted()) {
            $request->session()->start();
        }

        if ($request->session()->has('locale')) {
            app()->setLocale($request->session()->get('locale'));
        } else {
            app()->setLocale('en');
        }

        return $next($request);
    }
}
