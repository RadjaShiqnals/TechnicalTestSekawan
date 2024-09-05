<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Approve Reservations') }}
        </h2>
    </x-slot>
    @foreach (App\Models\ReservationModel::where('approver_id', auth()->user()->id_users)->where('admin_approval', 'approved')->get() as $reservation)
        @if ($reservation->approver_id === auth()->user()->id_users)
            <form action="{{ route('reservations.approve', $reservation->id_reservations) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mt-4">
                    <div class="mt-4">
                        <label for="id_reservations" class="block text-sm font-medium text-gray-700">Reservation</label>
                        <select id="id_reservations" name="id_reservations"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            required>
                            <option value="{{ $reservation->id_reservations }}">{{ $reservation->id_reservations }}</option>
                        </select>
                        @error('affirmation_status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <label for="approval_note" class="block text-sm font-medium text-gray-700">Approval Note</label>
                    <textarea id="approval_note" name="approval_note"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>{{ $reservation->approval_notes }}</textarea>
                    @error('approval_note')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <label for="affirmation_status" class="block text-sm font-medium text-gray-700">Affirmation Status</label>
                    <select id="affirmation_status" name="affirmation_status"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        required>
                        <option value="{{ $reservation->affirmation_status }}">{{ $reservation->affirmation_status }}</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                    @error('affirmation_status')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Approve Reservation
                    </button>
                </div>
            </form>
        @endif
    @endforeach
</x-app-layout>
