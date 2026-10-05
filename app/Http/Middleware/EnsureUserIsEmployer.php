<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsEmployer
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user()->role !== 'employer') {
            return redirect('/');
        }

        return $next($request);
    }
}
