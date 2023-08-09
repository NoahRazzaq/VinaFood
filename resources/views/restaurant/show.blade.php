<x-app-layout>

    <div class="mb-15">
        <div class="mb-10">
            <x-restaurant-card-detail :restaurant="$restaurant" :availableDays="$restaurant->availableDays" />
        </div>

        <div class="flex justify-center space-x-4 mt-4">
            <a class="text-blue-600 hover:text-blue-800"
                href="/restaurants/deleteRestaurant/{{ $restaurant->id }}">Supprimer</a>
            <a class="text-blue-600 hover:text-blue-800" href="/restaurants/{{ $restaurant->id }}/edit">Modifier</a>
        </div>
    </div>

    <br>
    <br>
    <div class="font-bold text-xl mb-8 ml-8 text-center">
        Les Produits ({{$restaurant->products->count()}})
    </div>

    <div class="flex flex-wrap justify-center gap-9">
        @foreach ($restaurant->products as $product)
            <x-product-card-restaurant :product="$product" />
        @endforeach
    </div>

</x-app-layout>

