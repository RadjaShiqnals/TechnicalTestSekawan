<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AllController;
use App\Http\Controllers\API\AllControllerWeb;

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

Route::get('/detail_reservation', function () {
    return view('detail_reservation');
})->name('detail_reservation');

Route::get('/make-detail-reservations', function () {
    return view('make_detail_reservations');
})->name('make_detail_reservations');

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
Route::post('/createReservationsWeb', [AllControllerWeb::class, 'createReservation'])->name('reservations.create');
// Route to create a new reservation
Route::post('/createVehicleWeb', [AllControllerWeb::class, 'createVehicle'])->name('vehicles.create');
// Route to create a new detail reservation
Route::post('/createDetailReservationWeb', [AllControllerWeb::class, 'createDetailReservation'])->name('detail_reservations.create');
// Route to approve a reservation
Route::post('/reservations/approveWeb', [AllControllerWeb::class, 'approveReservation'])->name('reservations.approve');
// Route to get all pending Reservation
Route::get('/listPendingReservationsWeb', [AllControllerWeb::class, 'listPendingReservations'])->name('reservations.list_pending');
// Route to get all pending Vehicles
Route::get('/listPendingVehiclesWeb', [AllControllerWeb::class, 'listPendingVehicles'])->name('vehicles.list_pending');
// Route to get all pending Drivers
Route::get('/listPendingDriversWeb', [AllControllerWeb::class, 'listPendingDrivers'])->name('drivers.list_pending');
// Route to get all reservations
Route::get('/getReservationsWeb', [AllControllerWeb::class, 'getReservations'])->name('reservations.get_all');
// Route to get all Vehicle
Route::get('/getVehicleWeb', [AllControllerWeb::class, 'getVehicle'])->name('vehicles.get_all');
// Route to get all Drivers
Route::get('/getDriversWeb', [AllControllerWeb::class, 'getDrivers'])->name('drivers.get_all');
// Route to get all Auth
Route::get('/getAuthWeb', [AllControllerWeb::class, 'getAuth'])->name('auth.get_all');


require __DIR__ . '/auth.php';
