<?php

namespace App\Http\Middleware;

use App\Models\Subscription;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserHasActiveSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = $request->header('x-user-id');
        $hasActive = Subscription::where('user_id', $userId)->where('status', 'active')->exists();
        if (!$hasActive) return response()->json(['message' => 'No active subscription found.'], 403);
        return $next($request);
    }
}
