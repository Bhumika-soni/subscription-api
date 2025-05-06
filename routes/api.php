<?php

use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/plans', [PlanController::class, 'index']);
Route::post('/subscriptions', [SubscriptionController::class, 'store']);
Route::put('/subscriptions/{id}/cancel', [SubscriptionController::class, 'cancel']);
Route::get('/users/{id}/subscriptions', [SubscriptionController::class, 'userSubscriptions']);
