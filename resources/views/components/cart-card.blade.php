@props(['restaurantOrders'])

<div class="container mx-auto mt-10">
    <div class="flex shadow-md my-10">
        <div class="w-3/4 bg-white px-10 py-10">
            <div class="flex justify-between border-b pb-8">
                <h1 class="font-semibold text-2xl"> {{ $restaurantOrders->first()->restaurant->name }}</h1>
                <h2 class="font-semibold text-2xl">
                    @if ($restaurantOrders->count() > 1)
                        <h2> {{ $restaurantOrders->count() }} plats commandés </h2>
                    @else
                        <h2> {{ $restaurantOrders->count() }} plat commandé </h2>
                    @endif
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
                            <div class="flex w-1/5"> <!-- Nom -->
                                <h3 class="text-sm"> {{ $orderline->product->name }}  </h3>
                            </div>
                            <div class="flex w-1/5"> <!-- Product Details -->
                                <div class="w-20">
                                    <img class="h-24"
                                        src="https://drive.google.com/uc?id=1vXhvO9HoljNolvAXLwtw_qX3WNZ0m75v"
                                        alt="">
                                </div>
                                <div class="flex flex-col justify-between ml-4 flex-grow">
                                    <span class="font-bold text-sm">{{ $orderline->user->name }}</span>
                                    <a href="/cart/delete/{{$order->id}}"
                                        class="font-semibold hover:text-red-500 text-gray-500 text-xs">remove</a>
                                </div>
                            </div>
                            <div class="flex justify-center w-1/5"> <!-- Quantity -->
                                <!-- Quantity input and icons -->
                                <span class="text-center w-1/5 font-semibold text-sm">{{ $orderline->quantity }}</span>

                            </div>
                            <span
                                class="text-center w-1/5 font-semibold text-sm">{{ $orderline->product->price }}</span>
                            <span class="text-center w-1/5 font-semibold text-sm">
                                @if ($orderline->quantity > 1)
                                    {{ $orderline->product->price * $orderline->quantity }}
                                @else
                                    {{ $orderline->product->price }}
                            </span>
                        @endif
                    </div>
                    @endforeach
                @endforeach

        <a href="#" class="flex font-semibold text-indigo-600 text-sm mt-10">
            <svg class="fill-current mr-2 text-indigo-600 w-4" viewBox="0 0 448 512">
                <path
                    d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z" />
            </svg>
            Continue Shopping
        </a>
    </div>
</div>
</div>
