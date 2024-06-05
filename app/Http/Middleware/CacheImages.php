<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheImages
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Check if the response is an image
        if (
            $response instanceof Response &&
            in_array($response->headers->get('Content-Type'), ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'])
        ) {
            error_log("");
            error_log("================");
            error_log("Image Cached");
            error_log("");
            error_log("");
            $response->headers->set('Cache-Control', 'public, max-age=86400'); // 86400 seconds = 1 day
        }

        return $response;
    }
}
