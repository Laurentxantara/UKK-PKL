<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RedirectRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->getRoleNames()->count()) {
            return redirect()->route('dashboard');
        }

        return $next($request);
    }
}
