<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AllController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);

// Route to create a new reservation
Route::post('/createReservations', [AllController::class, 'createReservation'])->middleware('auth:api');

// Route to create a new reservation
Route::post('/createVehicle', [AllController::class, 'createVehicle'])->middleware('auth:api');

// Route to approve a reservation
Route::post('/reservations/{id}/approve', [AllController::class, 'approveReservation'])->middleware('auth:api');

// Route to get all reservations
Route::get('/getReservations', [AllController::class, 'getReservations'])->middleware('auth:api');

// Route to get a single reservation by ID
Route::get('/reservations/{id}', [AllController::class, 'getReservation'])->middleware('auth:api');

// Route to get vehicle usage statistics
Route::get('/vehicle-usage', [AllController::class, 'getVehicleUsage'])->middleware('auth:api');