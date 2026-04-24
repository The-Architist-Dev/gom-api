<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddCOOPHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Handle OPTIONS preflight - return immediately without COOP header
        if ($request->isMethod('OPTIONS')) {
            return $next($request);
        }
        
        $response = $next($request);
        
        // Only add COOP header for non-OPTIONS requests
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin-allow-popups');
        
        return $response;
    }
}
