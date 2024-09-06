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

    // Create a new vehicle
    public function createVehicle(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Ensure the user is an admin
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Validate the request data
        $request->validate([
            'plate_number' => 'required|string|unique:vehicles,plate_number',
            'model' => 'required|string',
            'ownership' => 'required|in:rented,company',
            'status' => 'required|in:available,in_used,pending',
            'locations' => 'required|string',
        ]);

        // Create a new vehicle
        $vehicle = VehiclesModel::create([
            'plate_number' => $request->plate_number,
            'model' => $request->model,
            'ownership' => $request->ownership,
            'status' => $request->status,
            'locations' => $request->locations
        ]);

        // Check if the vehicle was created successfully
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
        // Get the authenticated user
        $user = Auth::user();

        // Ensure the user is an admin
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Get the driver and vehicle from the request
        $driver = DriversModel::find($request->id_drivers);
        $vehicle = VehiclesModel::find($request->id_vehicles);

        // Check if the driver or vehicle is already assigned, pending, or in use
        if ($driver->status === 'pending' || $driver->status === 'assigned' || $vehicle->status === 'pending' || $vehicle->status === 'in_used') {
            return response()->json([
                'success' => false,
                'message' => 'The vehicle or driver is already assigned, pending, or in use.'
            ], 400);
        } else {
            // Validate the request data
            $request->validate([
                'id_vehicles' => 'required|exists:vehicles,id_vehicles',
                'id_drivers' => 'required|exists:drivers,id_drivers',
                'approver_id' => 'required|exists:users,id_users,role,approver',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'purpose' => 'required|string',
                'admin_approval' => 'required|in:approved,rejected',
            ]);

            // Create a new reservation
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

            // Update the driver and vehicle status
            $driver->update(['status' => 'pending']);
            $vehicle->update(['status' => 'pending']);

            $driver = DriversModel::find($request->id_drivers);
            $driver->update([
                'status' => 'pending'
            ]);

            $vehicle = VehiclesModel::find($request->id_vehicles);
            $vehicle->update([
                'status' => 'pending'
            ]);

            // Check if the reservation was created successfully
            if ($reservation) {
                return response()->json([
                    'success' => true,
                    'message' => 'Reservation created successfully.',
                    'data' => $reservation
                ], 201);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Reservation creation failed.'
                ], 400);
            }
        }

    }

    // Approve a reservation

    // Approve a reservation
    public function approveReservation(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();

        // Ensure the user is an approver
        if ($user->role !== 'approver') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Validate the request data
        $request->validate([
            'id_reservations' => 'required|exists:reservations,id_reservations',
            'approval_note' => 'required|string',
            'affirmation_status' => 'required|in:approved,rejected',
        ]);

        // Get the reservation
        $reservation = ReservationModel::find($request->id_reservations);

        // Check if the user is the approver
        if ($reservation->approver_id !== $user->id_users) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Update the reservation
        $reservation->update([
            'affirmation_approval' => $request->affirmation_status
        ]);

        // Check if the reservation is approved
        if ($reservation->admin_approval === 'approved' && $reservation->affirmation_approval === 'approved') {
            // Get the vehicle and driver
            $vehicle = VehiclesModel::where('id_vehicles', $reservation->id_vehicles)->first();
            $driver = DriversModel::where('id_drivers', $reservation->id_drivers)->first();

            // Update the vehicle and driver status
            $vehicle->update(['status' => 'in_used']);
            $driver->update(['status' => 'assigned']);
        } else if ($reservation->admin_approval === 'rejected' && $reservation->affirmation_approval === 'rejected') {
            // Get the vehicle and driver
            $vehicle = VehiclesModel::where('id_vehicles', $reservation->id_vehicles)->first();
            $driver = DriversModel::where('id_drivers', $reservation->id_drivers)->first();

            // Update the vehicle and driver status
            $vehicle->update(['status' => 'available']);
            $driver->update(['status' => 'unassigned']);
        }

        // Create a new approval note
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
        // Get all reservations that are pending

        $reservations = ReservationModel::where(function ($query) {
            $query->where('admin_approval', 'pending')->orWhere('affirmation_approval', 'pending');
        })->get();

        return response()->json($reservations);
    }

    // List pending vehicles
    public function listPendingVehicles()
    {
        // Get all vehicles that are pending


        $vehicle = VehiclesModel::where('status', 'pending')->get();

        return response()->json($vehicle);
    }

    // List pending drivers
    public function listPendingDrivers()
    {
        // Get all drivers that are pending


        $driver = DriversModel::where('status', 'pending')->get();

        return response()->json($driver);
    }


    // Get all reservations
    public function getReservations()
    {
        // Get all reservations
        $reservations = ReservationModel::all();

        return response()->json($reservations);
    }

    // Get all vehicles
    public function getVehicle()
    {
        // Get all vehicles
        $vehicle = VehiclesModel::all();

        return response()->json($vehicle);
    }

    // Get all drivers
    public function getDrivers()
    {
        // Get all drivers
        $drivers = DriversModel::all();

        return response()->json($drivers);
    }

    // Get the authenticated user
    public function getAuth()
    {
        // Get the authenticated user
        $user = User::all();

        return response()->json($user);
    }

    // Create a new detail reservation
    
    public function createDetailReservation(Request $request)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Validate the request data
        $request->validate([
            'id_reservations' => 'required|exists:reservations,id_reservations|unique:detail_reservations,id_reservations',
            'fuel_consumption' => 'required|numeric',
            'note' => 'required|string'
        ]);

        // Get the reservation
        $reservation = ReservationModel::find($request->id_reservations);

        // Check if the reservation is approved
        if ($reservation->admin_approval !== 'approved' || $reservation->affirmation_approval !== 'approved') {
            return response()->json([
                'success' => false,
                'message' => 'Reservation not approved'
            ], 400);
        } else {
            // Create a new detail reservation
            $detail_reservation = DetailReservationModel::create([
                'id_reservations' => $request->id_reservations,
                'fuel_consumption' => $request->fuel_consumption,
                'note' => $request->note
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Detail Reservation created successfully',
                'data' => $detail_reservation
            ]);
        }
    }
}