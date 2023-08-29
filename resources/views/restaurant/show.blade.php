<x-app-layout>
    <div class="flex flex-col items-center justify-center">
                <x-restaurant-card-detail :restaurant="$restaurant" :availableDays="$restaurant->availableDays" />

            <div class="flex justify-center space-x-4 mt-4">
                <a class="text-blue-600 hover:text-blue-800"
                    href="/restaurants/deleteRestaurant/{{ $restaurant->id }}">Supprimer</a>
                <a class="text-blue-600 hover:text-blue-800" href="/restaurants/{{ $restaurant->id }}/edit">Modifier</a>
            </div>
        </div>

        <br>
        <br>
        <div class="font-bold text-xl mb-8 text-center">
            Les Produits ({{$restaurant->products->count()}})
        </div>
        <div class="flex justify-center space-x-4 mt-4">
            <a class="text-blue-600 hover:text-blue-800 p-10" href="{{ route('product.create', ['restaurant' => $restaurant->id]) }}">Ajouter un produit à {{ $restaurant->name }}</a>
        </div>

        <div class="flex flex-wrap justify-center gap-9 mt-4">
            @foreach ($restaurant->products as $product)
                <x-product-card-restaurant :product="$product" />
            @endforeach
        </div>
    </div>
</x-app-layout>

