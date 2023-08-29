<x-app-layout>

    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight">
                Les restaurants
            </h2>
            <div class="space-x-4">
                <a class="text-blue-600 hover:text-blue-800" href="{{ route('restaurant.create') }}">Ajouter un
                    restaurant</a>
            </div>
        </div>
    </x-slot>

    <div class="flex flex-wrap justify-center gap-9">
        @foreach ($restaurants as $restaurant)
            <x-restaurant-card :restaurant="$restaurant" :availableDays="$restaurant->availableDays" />
        @endforeach
    </div>




</x-app-layout>
