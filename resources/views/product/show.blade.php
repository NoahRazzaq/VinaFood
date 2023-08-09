<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight">

        </h2>
    </x-slot>

    <div class="flex justify-center items-center h-full">
        <x-product-detail-card :product="$product" :users="$users" />
    </div>

   
    <div class="flex justify-center space-x-4 mt-4">
        <a class="text-blue-600 hover:text-blue-800" href="/products/deleteProduct/{{$product->id}}">Supprimer</a>
        <a class="text-blue-600 hover:text-blue-800" href="/products/{{$product->id}}/edit">Modifier</a>
    </div>
</x-app-layout>
