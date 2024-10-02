<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ManagerMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->isManager()) {
            return $next($request);
        }

        return redirect('/');
    }
}
