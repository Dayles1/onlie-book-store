<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
=======
>>>>>>> bb751307b77b17783c9fe9784738c97aab362d49
use Symfony\Component\HttpFoundation\Response;

class CheckStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
<<<<<<< HEAD
    {
        $user=Auth::user();
        if ($user->status == 'user') {
            return response()->json([
                'message' => __('messages.user.status'),
                'status' => false,
            ], 403);
            
        }
        
=======
    {   
        if ( $user->status !== 'admin') {
             return response()->json(['message' => 'Unauthorized.'], 403);
        }

>>>>>>> bb751307b77b17783c9fe9784738c97aab362d49
        return $next($request);
    }
}
