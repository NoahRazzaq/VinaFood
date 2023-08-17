<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight">
            Récapitulatif des commandes
        </h2>
    </x-slot>


    <h1>Commandes du : {{ date('d/m/Y') }}</h1>

    @foreach ($ordersByRestaurant as $restaurantId => $restaurantOrders)

        <x-cart-card :restaurantOrders="$restaurantOrders" />

    @endforeach

</x-app-layout>
