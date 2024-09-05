<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Reservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('reservations.create') }}" method="POST">
                        @csrf

                        <div class="mt-4">
                            <label for="id_vehicles" class="block text-sm font-medium text-gray-700">Vehicle</label>
                            <select id="id_vehicles" name="id_vehicles"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Select a vehicle</option>
                                @foreach (App\Models\VehiclesModel::where('status', 'available')->get() as $vehicle)
                                    <option value="{{ $vehicle->id_vehicles }}">
                                        {{ $vehicle->model }} - 
                                        {{ $vehicle->plate_number }} - 
                                        {{ $vehicle->ownership }} - 
                                        {{ $vehicle->locations }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_vehicles')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="id_drivers" class="block text-sm font-medium text-gray-700">Driver</label>
                            <select id="id_drivers" name="id_drivers"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Select a driver</option>
                                @foreach (App\Models\DriversModel::where('status', 'unassigned')->get() as $driver)
                                    <option value="{{ $driver->id_drivers }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                            @error('id_drivers')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="approver_id" class="block text-sm font-medium text-gray-700">Approver</label>
                            <select id="approver_id" name="approver_id"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Select an approver</option>
                                @foreach (App\Models\User::where('role', 'approver')->get() as $user)
                                    <option value="{{ $user->id_users }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('approver_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                            <input type="date" id="start_date" name="start_date"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                            @error('start_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                            <input type="date" id="end_date" name="end_date"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                            @error('end_date')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="purpose" class="block text-sm font-medium text-gray-700">Purpose</label>
                            <textarea id="purpose" name="purpose"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required></textarea>
                            @error('purpose')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="admin_approval" class="block text-sm font-medium text-gray-700">Admin
                                Approval</label>
                            <select id="admin_approval" name="admin_approval"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Select an option</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                            </select>
                            @error('admin_approval')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Create Reservation
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
