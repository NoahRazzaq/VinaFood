@props(['restaurantOrders'])

<div class="container mx-auto mt-10">
    <div class="flex shadow-md my-10">
        <div class="w-3/4 bg-white px-10 py-10">
            <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-xl">{{ $restaurantOrders->first()->restaurant->name }}</h1>
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
                @foreach ($order->orderlines as $index => $orderline)
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5">
                        @if ($loop->first && $orderline->product != ($order->orderlines[$index - 1]->product ?? null))
                            <div class="flex w-1/5">
                                <!-- Nom -->
                                <h3 class="text-sm">{{ $orderline->product->name }}</h3>
                            </div>
                        @else
                            <div class="w-1/5"></div>
                        @endif
                        <div class="flex w-1/5">
                            <!-- Product Details -->
                            <div class="flex flex-col justify-between ml-4 flex-grow">
                                <span class="font-bold text-sm">{{ $orderline->user->name }}</span>
                                <a href="/cart/delete/{{$order->id}}"
                                    class="font-semibold hover:text-red-500 text-gray-500 text-xs">remove</a>
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

        </div>
        <div>
            @if ($order->mail_sent == 1)
            <button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Commande confirmé</button>

            @else
                
            <form action="{{ route('cart.confirmOrder', ['order' => $order->id]) }}" method="get">
                <button type="submit" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-3 h-3 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                        <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                        <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                    </svg>
                    Confimer 
                </button>
            </form>
            @endif
           
        </div>
    </div>
</div>
