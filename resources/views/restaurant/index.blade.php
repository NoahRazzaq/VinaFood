<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Restaurants
        </h2>
    </x-slot>
    
    <div class="grid grid-cols-4">
        @foreach ($restaurants as $restaurant)
            <div class="flex flex-col justify-center items-center">
                <img src="{{ $restaurant->image }}" class="object-contain" alt="restaurant-image" />
                <a href="{{ route('restaurant.show', ['id' => $restaurant->id]) }}">
                    {{$restaurant->name}}
                </a>
            </div>
        @endforeach
    </div>

</x-app-layout>