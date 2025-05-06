<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = \App\Models\Plan::withCount(['subscriptions' => function ($q) {
            $q->where('status', 'active');
        }])->get();

        return response()->json($plans);
    }
}
