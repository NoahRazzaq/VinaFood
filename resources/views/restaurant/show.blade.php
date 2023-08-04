<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $restaurant->name }}
        </h2>
    </x-slot>

    {{ $restaurant->name }}
    {{ $restaurant->phone }}
    {{ $restaurant->city }}

    @foreach ($restaurant->products as $product)
        <p>{{ $product->name }}</p>
    @endforeach


    <a class="" href="/restaurants/deleteRestaurant/{{ $restaurant->id }}">Supprimer</a>
    <a class="" href="/restaurants/{{ $restaurant->id }}/edit">Modifier</a>

</x-app-layout>
