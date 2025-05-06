<?php

use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Middleware\CheckUserHasActiveSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
                       
Route::middleware('api')->group(function () {
    Route::get('/plans', [PlanController::class, 'listPlans']);
    Route::post('/subscriptions', [SubscriptionController::class, 'createSubscription']);
    Route::put('/subscriptions/{id}/cancel', [SubscriptionController::class, 'cancelSubscription'])
        ->middleware(CheckUserHasActiveSubscription::class);
    Route::get('/users/{id}/subscriptions', [SubscriptionController::class, 'userSubscriptions']);
});
