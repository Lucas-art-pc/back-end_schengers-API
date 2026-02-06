<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttachBearerTokenFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            $request->hasCookie('teacher_token') &&
            ! $request->headers->has('Authorization')
        ) {
            $request->headers->set(
                'Authorization',
                'Bearer ' . $request->cookie('teacher_token')
            );
        }

        return $next($request);
    }
}
