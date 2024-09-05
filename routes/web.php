<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AllController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/reservations', function () {
    if (Auth::check() && Auth::user()->role === 'approver') {
        return view('approver_reservations');
    }
    return view('reservations');
})->name('reservations');

Route::get('/make-reservations', function () {
    return view('make_reservations');
})->name('make_reservations');

Route::get('/approve-reservations', function () {
    return view('approve_reservations');
})->name('approve_reservations');

Route::get('/vehicles', function () {
    return view('vehicles');
})->name('vehicles');

Route::get('/drivers', function () {
    return view('drivers');
})->name('drivers');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Route to create a new reservation
Route::post('/createReservations', [AllController::class, 'createReservation'])->name('reservations.create');
// Route to create a new reservation
Route::post('/createVehicle', [AllController::class, 'createVehicle'])->name('vehicles.create');
// Route to create a new detail reservation
Route::post('/createDetailReservation', [AllController::class, 'createDetailReservation'])->name('detail_reservations.create');
// Route to approve a reservation
Route::post('/reservations/approve', [AllController::class, 'approveReservation'])->name('reservations.approve');
// Route to get all pending Reservation
Route::get('/listPendingReservations', [AllController::class, 'listPendingReservations'])->name('reservations.list_pending');
// Route to get all pending Vehicles
Route::get('/listPendingVehicles', [AllController::class, 'listPendingVehicles'])->name('vehicles.list_pending');
// Route to get all pending Drivers
Route::get('/listPendingDrivers', [AllController::class, 'listPendingDrivers'])->name('drivers.list_pending');
// Route to get all reservations
Route::get('/getReservations', [AllController::class, 'getReservations'])->name('reservations.get_all');
// Route to get all Vehicle
Route::get('/getVehicle', [AllController::class, 'getVehicle'])->name('vehicles.get_all');
// Route to get all Drivers
Route::get('/getDrivers', [AllController::class, 'getDrivers'])->name('drivers.get_all');
// Route to get all Auth
Route::get('/getAuth', [AllController::class, 'getAuth'])->name('auth.get_all');


require __DIR__ . '/auth.php';
