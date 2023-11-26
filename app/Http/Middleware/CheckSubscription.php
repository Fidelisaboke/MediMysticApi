<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Either the user is a premium user or an admin
        if(auth()->user()->subscription_level === 'premium' || get_class(auth()->user()) === 'App\Models\Admin'){
            return $next($request);
        }else{
            return response()->json(['error' => 'Unauthorized. Premium users only'], 403);
        }
    }
}
