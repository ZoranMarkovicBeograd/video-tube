<?php

namespace App\Http\Middleware;

use App\Models\Video;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeVideoOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $video = $request->route('video');

        return auth()->id() !== $video->user_id ? abort(403) : $next($request);
    }
}
