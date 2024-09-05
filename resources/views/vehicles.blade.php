<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Vehicles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach(App\Models\VehiclesModel::all() as $vehicle)
                            <div class="border border-gray-300 rounded-lg p-4 shadow-lg">
                                <h3 class="font-semibold text-lg">{{ $vehicle->model }}</h3>
                                <p><strong>Plate Number:</strong> {{ $vehicle->plate_number }}</p>
                                <p><strong>Ownership:</strong> {{ $vehicle->ownership }}</p>
                                <p><strong>Status:</strong>
                                    @if ($vehicle->status === 'available')
                                        <span class="text-green-600">{{ $vehicle->status }}</span>
                                    @elseif ($vehicle->status === 'in_used')
                                        <span class="text-red-600">{{ $vehicle->status }}</span>
                                    @else
                                        <span class="text-blue-600">{{ $vehicle->status }}</span>
                                    @endif
                                </p>
                                <p><strong>Location:</strong> {{ $vehicle->locations }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
