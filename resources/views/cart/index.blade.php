<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight">
            Récapitulatif des commandes
        </h2>
    </x-slot>

    <div class="flex justify-center items-center">
        <div class="w-full max-w-8xl">
            <h1 class="text-center text-xl mb-4">Commandes du : {{ date('d/m/Y') }}</h1>
            
            @foreach ($ordersByRestaurant as $restaurantId => $restaurantOrders)
                <div class="mx-auto mb-6">
                    <x-cart-card :restaurantOrders="$restaurantOrders" />
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
