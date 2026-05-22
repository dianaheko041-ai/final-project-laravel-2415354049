<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\SubscriptionController;

Route::apiResource('services', ServiceController::class);
Route::apiResource('customers', CustomerController::class);
Route::apiResource('subscriptions', SubscriptionController::class);
Route::get('services/status/{status}', [ServiceController::class, 'getByStatus']);
Route::patch('services/{id}/status',[ServiceController::class, 'changeStatus']);