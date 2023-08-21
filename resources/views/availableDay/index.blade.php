<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight">
            Les jours de la semaine
        </h2>
    </x-slot>

    <div>
        @foreach ($days as $day)
        <x-day-card :day="$day" />
        @endforeach
    </div>
</x-app-layout>