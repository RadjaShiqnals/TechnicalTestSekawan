<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reservations') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('approve_reservations') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Approve Reservation
                    </a>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-4">
                        @foreach(App\Models\ReservationModel::where('approver_id', Auth::user()->id_users)->get() as $reservation)
                            <div class="border border-gray-300 rounded-lg p-4 shadow-lg">
                                <h3 class="font-semibold text-lg">{{ $reservation->vehicle->model }}</h3>
                                <p><strong>User:</strong> {{ $reservation->id_users }}</p>
                                <p><strong>Vehicle:</strong> {{ $reservation->id_vehicles }}</p>
                                <p><strong>Driver:</strong> {{ $reservation->id_drivers }}</p>
                                <p><strong>Start Date:</strong> {{ $reservation->start_date }}</p>
                                <p><strong>End Date:</strong> {{ $reservation->end_date }}</p>
                                <p><strong>Approver:</strong> {{ $reservation->approver_id }}</p>
                                <p><strong>Purpose:</strong> {{ $reservation->purpose }}</p>
                                <p><strong>Admin Approval:</strong>
                                    @if ($reservation->admin_approval === 'approved')
                                        <span class="text-green-600">{{ $reservation->admin_approval }}</span>
                                    @elseif ($reservation->admin_approval === 'rejected')
                                        <span class="text-red-600">{{ $reservation->admin_approval }}</span>
                                    @elseif ($reservation->admin_approval === 'pending')
                                        <span class="text-blue-600">{{ $reservation->admin_approval }}</span>
                                    @else
                                        <span class="text-gray-600">null</span>
                                    @endif
                                </p>
                                <p><strong>Affirmation Approval:</strong>
                                    @if ($reservation->affirmation_approval === 'approved')
                                        <span class="text-green-600">{{ $reservation->affirmation_approval }}</span>
                                    @elseif ($reservation->affirmation_approval === 'rejected')
                                        <span class="text-red-600">{{ $reservation->affirmation_approval }}</span>
                                    @else
                                        <span class="text-blue-600">{{ $reservation->affirmation_approval }}</span>
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
