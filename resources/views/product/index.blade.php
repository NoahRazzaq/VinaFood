<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight flex justify-center items-center">
                Les produits
            </h2>
            <div class="space-x-4">
                <a href="{{ route('product.create') }}" class="text-blue-600 hover:text-blue-800 text-right">Ajouter un produit</a>
            </div>
        </div>
    </x-slot>


    <div class="flex flex-wrap justify-center">
        @foreach ($products as $product)
            <div class="w-full md:w-1/3 p-10">
                <x-product-card :product="$product" />
            </div>
        @endforeach
    </div>


</x-app-layout>
