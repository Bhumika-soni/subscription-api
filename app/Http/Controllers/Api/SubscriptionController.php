<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    use ApiResponse;
    
    public function createSubscription(Request $request) 
    {
        $request->validate([
            'plan_id' => 'required|exists:plans,id'
        ]);
    
        $userId = $request->header('x-user-id');
        if(!$userId) {
            return $this->errorResponse('Please Provide valid UserId.');
        }

        $user = User::where('id', $userId)->first();
        if(!$user){
            return $this->errorResponse('user not found', 200);
        }
        
        $plan = Plan::where('id', $request->plan_id)->first();
        if(!$plan){
            return $this->errorResponse('plan not found', 200);
        }
    
        $user->subscriptions()->where('status', 'active')->update(['status' => 'cancelled']);
    
        $start = now();
        $end = now()->addDays($plan->duration);
    
        $subscription = $user->subscriptions()->create([
            'plan_id' => $plan->id,
            'start_date' => $start,
            'end_date' => $end,
            'status' => 'active'
        ]);
    
        return $this->successResponse($subscription, 'user subscription created.', 201);
    }
    
    public function cancelSubscription($id, Request $request) 
    {
        $userId = $request->header('x-user-id');
        $subscription = Subscription::where('id', $id)->where('user_id', $userId)->first();
        if(!$subscription) {
            return $this->errorResponse('subscription not found for this user.', 200);
        }

        $subscription->update(['status' => 'cancelled']);

        return $this->successResponse([], 'subscription cancelled Successfully.', 200);
    }
    
    public function userSubscriptions($id) 
    {
        $subs = Subscription::with('plan')->where('user_id', $id)->get();
        if(!$subs->isEmpty()) {
            return $this->errorResponse('subscription not found for this user.', 200);
        }
        return $this->successResponse($subs, 'get user subscriptions.', 200);
    }
    
}
