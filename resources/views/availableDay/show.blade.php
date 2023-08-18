<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight">
            {{ $day->day }} 
        </h2>
    </x-slot>

    <div>
        <div class="flex flex-wrap justify-center gap-9">

        @foreach ($day->restaurants as $restaurant)
        <x-restaurant-card :restaurant="$restaurant" :availableDays="$restaurant->availableDays" />
            @endforeach
    </div>
</x-app-layout>
