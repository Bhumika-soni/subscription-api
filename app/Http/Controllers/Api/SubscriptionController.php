<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id',
        ]);

        $userId = $request->header('x-user-id');
        $user = \App\Models\User::findOrFail($userId);
        $plan = \App\Models\Plan::findOrFail($request->plan_id);

        // Cancel existing active subscriptions
        $user->subscriptions()->where('status', 'active')->update(['status' => 'cancelled']);

        $subscription = Subscription::create([
            'user_id' => $user->id,
            'plan_id' => $plan->id,
            'start_date' => now(),
            'end_date' => now()->addDays($plan->duration),
            'status' => 'active',
        ]);

        return response()->json($subscription, 201);
    }

    public function cancel($id, Request $request)
    {
        $userId = $request->header('x-user-id');
        $subscription = Subscription::where('id', $id)->where('user_id', $userId)->firstOrFail();

        if ($subscription->status !== 'active') {
            return response()->json(['message' => 'Subscription is not active'], 400);
        }

        $subscription->update(['status' => 'cancelled']);

        return response()->json(['message' => 'Subscription cancelled']);
    }

    public function userSubscriptions($id)
    {
        $user = \App\Models\User::with('subscriptions.plan')->findOrFail($id);
        return response()->json($user->subscriptions);
    }
}
