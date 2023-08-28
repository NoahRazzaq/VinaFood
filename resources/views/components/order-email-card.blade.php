@props(['groupedOrders'])




@foreach ($groupedOrders as $restaurantId => $restaurantOrders)
    <div class="container mx-auto mt-10">
        <div class="w-3/4 bg-white px-10 py-10">
            <div class="flex justify-between border-b pb-8">
                <a href="{{ route('restaurant.show', ['restaurant' => $restaurantOrders->first()->restaurant->id]) }}">
                    <h1 class="font-semibold text-xl">Commande pour {{ $restaurantOrders->first()->restaurant->name }}</h1>
                </a>
                <h2 class="font-semibold text-xl">
                    @if ($restaurantOrders->count() > 1)
                        {{ $restaurantOrders->count() }} plats commandés
                    @else
                        {{ $restaurantOrders->count() }} plat commandé
                    @endif
                </h2>
            </div>

            <div class="flex mt-10 mb-5">
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/5">Product Details</h3>
                <h3 class="font-semibold text-gray-600 text-xs uppercase w-1/5">Nom</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Quantité</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Prix</h3>
                <h3 class="font-semibold text-center text-gray-600 text-xs uppercase w-1/5">Total</h3>
            </div>

            @foreach ($restaurantOrders as $order)
                @foreach ($order->orderlines as $orderline)
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                        <div class="flex w-1/5">
                            <!-- Nom -->
                            <a href="{{ route('product.show', ['product' => $orderline->product->id]) }}">
                                <h3 class="text-sm">{{ $orderline->product->name }}</h3>
                            </a>
                        </div>
                        <div class="flex w-1/5">
                            <!-- Product Details -->
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm">{{ $orderline->user->name }}</span>
                            </div>
                        </div>
                        <div class="flex justify-center w-1/5">
                            <!-- Quantity -->
                            <span class="text-center w-1/5 font-semibold text-sm">{{ $orderline->quantity }}</span>
                        </div>
                        <span class="text-center w-1/5 font-semibold text-sm">{{ $orderline->product->price }}€</span>
                        <span class="text-center w-1/5 font-semibold text-sm">
                            @if ($orderline->quantity > 1)
                                {{ $orderline->product->price * $orderline->quantity }}€
                            @else
                                {{ $orderline->product->price }}€
                            @endif
                        </span>
                    </div>
                @endforeach
            @endforeach
@endforeach

</div>
</div>
