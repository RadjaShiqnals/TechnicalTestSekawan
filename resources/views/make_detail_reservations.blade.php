<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Detail Reservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('detail_reservations.create') }}" method="POST">
                        @csrf

                        <div class="mt-4">
                            <label for="id_reservations" class="block text-sm font-medium text-gray-700">Detail Reservation</label>
                            <select id="id_reservations" name="id_reservations"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Select a reservation</option>
                                @foreach (App\Models\DetailReservationModel::all() as $detail)
                                    <option value="{{ $detail->id_reservations }}">
                                        {{ $detail->id_reservations }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_reservations')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="fuel_consumption" class="block text-sm font-medium text-gray-700">Fuel Consumption</label>
                            <input type="number" step="0.01" id="fuel_consumption" name="fuel_consumption"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                            @error('fuel_consumption')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <label for="note" class="block text-sm font-medium text-gray-700">Note</label>
                            <textarea id="note" name="note"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required></textarea>
                            @error('note')
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
