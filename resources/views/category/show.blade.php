<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight">
                {{ $category->name }}
            </h2>
            <div class="space-x-4">
                <a class="text-blue-600 hover:text-blue-800" href="{{ route('product.create', ['category' => $category->id]) }}">Ajouter un produit</a>
                <a class="text-blue-600 hover:text-blue-800" href="/categories/deleteCategory/{{ $category->id }}">Supprimer</a>
            </div>
        </div>
    </x-slot>
    
`
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
