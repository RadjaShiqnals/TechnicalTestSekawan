<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\ReservationModel;
use App\Models\VehiclesModel;
use App\Models\DriversModel;
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

        $request->validate([
            'id_vehicles' => 'required|exists:vehicles,id_vehicles',
            'id_drivers' => 'required|exists:drivers,id_drivers',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'purpose' => 'required|string',
            'approver2' => 'nullable|exists:users,id_users'
        ]);

        $driver = DriversModel::find($request->id_drivers);
        $vehicle = VehiclesModel::find($request->id_vehicles);

        if ($driver->status === 'assigned' || $vehicle->status === 'pending' || $vehicle->status === 'in_used') {
            return response()->json([
                'success' => false,
                'message' => 'The vehicle or driver is already assigned, pending, or in use.'
            ], 400);
        }

        $reservation = ReservationModel::create([
            'id_users' => $user->id_users,
            'id_vehicles' => $request->id_vehicles,
            'id_drivers' => $request->id_drivers,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'purpose' => $request->purpose,
            'approver1' => $user->id_users,
            'approver2' => $request->approver2
        ]);

        if ($request->id_drivers) {
            DriversModel::where('id_drivers', $request->id_drivers)->update([
                'status' => 'assigned'
            ]);
        }

        VehiclesModel::where('id_vehicles', $request->id_vehicles)->update([
            'status' => 'pending'
        ]);

        return response()->json(['success' => true, 'message' => 'Reservation created successfully.']);
    }

    // Approve a reservation
    public function approveReservation($id, Request $request)
    {
        $user = Auth::user();
        
        // Ensure the user is either an admin or an approver
        if ($user->role !== 'admin' && $user->role !== 'approver') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $reservation = ReservationModel::findOrFail($id);
        
        // Admin can approve or any approver assigned to this reservation can approve
        if ($user->role === 'admin' || $reservation->approver_id === $user->id) {
            $request->validate([
                'approval_note' => 'required|string'
            ]);

            $reservation->status = 'approved';
            $reservation->save();

            // Optionally, store the approval note
            // ApprovalNote::create([
            //     'reservation_id' => $reservation->id,
            //     'approver_id' => $user->id,
            //     'note' => $request->approval_note
            // ]);

            return response()->json(['success' => true, 'message' => 'Reservation approved successfully.']);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    // List pending reservations (for approvers)
    public function listPendingReservations()
    {
        $user = Auth::user();
        
        if ($user->role !== 'approver') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $reservations = ReservationModel::where('status', 'pending')->get();

        return response()->json($reservations);
    }

    // Other methods (e.g., for dashboard) can be added here
}
