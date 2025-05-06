<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    use ApiResponse;

    public function listPlans() 
    {
        $plans = Plan::withCount(['subscriptions' => function($q) {
            $q->where('status', 'active');
        }])->get();

        if(!$plans->isEmpty()){
            return $this->errorResponse('Plan not Found.', 204);
        }

        return $this->successResponse($plans, 'Get Plans Successfully.');
    }
}
