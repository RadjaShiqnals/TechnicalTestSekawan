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
Route::post('/reservations/approve', [AllController::class, 'approveReservation'])->middleware('auth:api');

// Route to get all pending Reservation
Route::get('/listPendingReservations', [AllController::class, 'listPendingReservations']);
// Route to get all pending Vehicles
Route::get('/listPendingVehicles', [AllController::class, 'listPendingVehicles']);
// Route to get all pending Drivers
Route::get('/listPendingDrivers', [AllController::class, 'listPendingDrivers']);
// Route to get all reservations
Route::get('/getReservations', [AllController::class, 'getReservations']);
// Route to get all Vehicle
Route::get('/getVehicle', [AllController::class, 'getVehicle']);
// Route to get all Drivers
Route::get('/getDrivers', [AllController::class, 'getDrivers']);
// Route to get all Auth
Route::get('/getAuth', [AllController::class, 'getAuth']);

// Route to get a single reservation by ID
Route::get('/reservations/{id}', [AllController::class, 'getReservation'])->middleware('auth:api');

// Route to get vehicle usage statistics
Route::get('/vehicle-usage', [AllController::class, 'getVehicleUsage'])->middleware('auth:api');