<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ApprovalNotesModel;
use App\Models\DetailReservationModel;
use App\Models\ReservationModel;
use App\Models\VehiclesModel;
use App\Models\DriversModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllController extends Controller
{

    public function createVehicle(Request $request)
    {
        $user = Auth::user();

        // Ensure the user is an admin
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'plate_number' => 'required|string|unique:vehicles,plate_number',
            'model' => 'required|string',
            'ownership' => 'required|in:rented,company',
            'status' => 'required|in:available,in_used,pending',
            'locations' => 'required|string',
        ]);

        $vehicle = VehiclesModel::create([
            'plate_number' => $request->plate_number,
            'model' => $request->model,
            'ownership' => $request->ownership,
            'status' => $request->status,
            'locations' => $request->locations
        ]);

        if ($vehicle) {
            return response()->json([
                'success' => true,
                'message' => 'Vehicle created successfully.',
                'data' => $vehicle
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Vehicle creation failed.'
            ], 400);
        }
    }
    // Create a new reservation
    public function createReservation(Request $request)
    {
        $user = Auth::user();

        // Ensure the user is an admin
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $driver = DriversModel::find($request->id_drivers);
        $vehicle = VehiclesModel::find($request->id_vehicles);

        if ($driver->status === 'pending' || $driver->status === 'assigned' || $vehicle->status === 'pending' || $vehicle->status === 'in_used') {
            return response()->json([
                'success' => false,
                'message' => 'The vehicle or driver is already assigned, pending, or in use.'
            ], 400);
        } else {
            $request->validate([
                'id_vehicles' => 'required|exists:vehicles,id_vehicles',
                'id_drivers' => 'required|exists:drivers,id_drivers',
                'approver_id' => 'required|exists:users,id_users,role,approver',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'purpose' => 'required|string',
                'admin_approval' => 'required|in:approved,rejected',
            ]);

            $reservation = ReservationModel::create([
                'id_users' => $user->id_users,
                'id_vehicles' => $request->id_vehicles,
                'id_drivers' => $request->id_drivers,
                'approver_id' => $request->approver_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'purpose' => $request->purpose,
                'admin_approval' => $request->admin_approval,
            ]);


            $driver = DriversModel::find($request->id_drivers);
            $driverupdate = $driver->update([
                'status' => 'pending'
            ]);

            $vehicle = VehiclesModel::find($request->id_vehicles);
            $vehicleupdate = $vehicle->update([
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Reservation created successfully.',
                'data' => [
                    'reservation' => $reservation,
                    'driver' => $driver->toArray(),
                    'vehicle' => $vehicle->toArray()
                ]
            ]);
        }

    }

    // Approve a reservation

    // Approve a reservation
    public function approveReservation(Request $request)
    {
        $user = Auth::user();

        // Ensure the user is an approver
        if ($user->role !== 'approver') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'id_reservations' => 'required|exists:reservations,id_reservations',
            'approval_note' => 'required|string',
            'affirmation_status' => 'required|in:approved,rejected',
        ]);

        $reservation = ReservationModel::find($request->id_reservations);

        if ($reservation->approver_id !== $user->id_users) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $reservation->update([
            'affirmation_approval' => $request->affirmation_status
        ]);
        if ($reservation->admin_approval === 'approved' && $reservation->affirmation_approval === 'approved') {
            $vehicle = VehiclesModel::where('id_vehicles', $reservation->id_vehicles)->first();
            $driver = DriversModel::where('id_drivers', $reservation->id_drivers)->first();

            $vehicle->update(['status' => 'in_used']);
            $driver->update(['status' => 'assigned']);
        }
        ApprovalNotesModel::create([
            'id_reservations' => $reservation->id_reservations,
            'approver_id' => $user->id_users,
            'note' => $request->approval_note
        ]);

        return response()->json([
            'message' => 'Reservation approved successfully.',
            'reservation' => $reservation,
            'approval_notes' => ApprovalNotesModel::where('id_reservations', $reservation->id_reservations)->latest()->first()
        ]);
    }
    // List pending reservations (for approvers)
    public function listPendingReservations()
    {

        $reservations = ReservationModel::where(function ($query) {
            $query->where('admin_approval', 'pending')->orWhere('affirmation_approval', 'pending');
        })->get();

        return response()->json($reservations);
    }
    public function listPendingVehicles()
    {


        $vehicle = VehiclesModel::where('status', 'pending')->get();

        return response()->json($vehicle);
    }
    public function listPendingDrivers()
    {


        $driver = DriversModel::where('status', 'pending')->get();

        return response()->json($driver);
    }


    // Get all reservations
    public function getReservations()
    {
        $reservations = ReservationModel::all();

        return response()->json($reservations);
    }

    public function getVehicle()
    {
        $vehicle = VehiclesModel::all();

        return response()->json($vehicle);
    }
    public function getDrivers()
    {
        $drivers = DriversModel::all();

        return response()->json($drivers);
    }
    public function getAuth()
    {
        $user = User::all();

        return response()->json($user);
    }
    
    public function createDetailReservation(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $request->validate([
            'id_reservations' => 'required|exists:reservations,id_reservations',
            'id_vehicles' => 'required|exists:vehicles,id_vehicles',
            'id_drivers' => 'required|exists:drivers,id_drivers'
        ]);

        $reservation = ReservationModel::find($request->id_reservations);

        if ($reservation->admin_approval !== 'approved' || $reservation->affirmation_approval !== 'approved') {
            return response()->json([
                'success' => false,
                'message' => 'Reservation not approved'
            ], 400);
        }

        $detail_reservation = DetailReservationModel::create([
            'id_reservations' => $request->id_reservations,
            'id_vehicles' => $request->id_vehicles,
            'id_drivers' => $request->id_drivers
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Detail Reservation created successfully',
            'data' => $detail_reservation
        ]);
    }
}
