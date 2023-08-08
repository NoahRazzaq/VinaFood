<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight">
            {{ $category->name }} 
        </h2>
        <a class="text-blue-600 hover:text-blue-800" href="/categories/deleteCategory/{{ $category->id }}">Supprimer</a>
    </x-slot>

    <div class="mt-8">
        <div class="flex flex-wrap justify-center">
            @foreach ($category->products as $product)
                <div class="w-full md:w-1/3 p-10">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </div>



</x-app-layout>
