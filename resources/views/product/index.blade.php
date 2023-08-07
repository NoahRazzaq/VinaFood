<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight">
            Les produits
        </h2>
    </x-slot>
    
    <div class="flex flex-wrap justify-center">
        @foreach ($products as $product)
            <div class="w-full md:w-1/3 p-10">
                <x-product-card :product="$product" />
            </div>
        @endforeach
    </div>
    

</x-app-layout>