<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight">
            Les restaurants
        </h2>
    </x-slot>

    <div class="flex flex-wrap justify-center gap-9">
        @foreach ($restaurants as $restaurant)
            <x-restaurant-card :restaurant="$restaurant" :availableDays="$restaurant->availableDays" />
        @endforeach
    </div>




</x-app-layout>
