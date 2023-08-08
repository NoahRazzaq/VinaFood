<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bienvenue {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div>
        <h1>Les produits disponible aujourd'hui </h1>
        @foreach ($products as $product)
            <div class="w-full md:w-1/3 p-10">
                <x-product-card :product="$product" />
            </div>
        @endforeach
    </div>


</x-app-layout>
