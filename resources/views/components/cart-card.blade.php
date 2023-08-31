@props(['restaurantOrders'])

<div class="container mx-auto mt-10">
    <div class="flex shadow-md my-10">
        <div class="w-3/4 bg-white px-10 py-10">
            <div class="flex justify-between border-b pb-8">
                <a href="{{ route('restaurant.show', ['restaurant' => $restaurantOrders->first()->restaurant->id]) }}">
                    <h1 class="font-semibold text-xl">{{ $restaurantOrders->first()->restaurant->name }}</h1>
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
                    <div class="flex items-center hover:bg-gray-100 -mx-8 px-6 py-5 relative">
                            <div class="flex w-1/5">
                                <!-- Nom -->
                                <a href="{{ route('product.show', ['product' => $orderline->product->id]) }}">

                                    <h3 class="text-sm text-center">{{ $orderline->product->name }}</h3>
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/RedDot_Burger.jpg/1280px-RedDot_Burger.jpg"
                                        alt="{{ $orderline->product->name }}" class="h-16 w-24 rounded-lg object-cover">
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
                            {{ $orderline->product->price * $orderline->quantity }}€
                        </span>
                        <a href="/cart/delete/{{ $order->id }}">
                            <svg class="w-5 h-5 fill-current text-gray-500 hover:text-red-500 cursor-pointer"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path
                                    d="M15 1h-3c0-0.552-0.448-1-1-1h-3c-0.552 0-1 0.448-1 1h-3c-1.104 0-2 0.896-2 2v1h14v-1c0-1.104-0.896-2-2-2zM4.52 4h10.96c0.496 0 0.951 0.276 1.18 0.716s0.194 1.019-0.135 1.459l-1.882 2.823h-7.924l-1.882-2.823c-0.329-0.44-0.358-0.982-0.135-1.459s0.684-0.716 1.18-0.716zM2 6h16v12c0 1.104-0.896 2-2 2h-12c-1.104 0-2-0.896-2-2v-12z" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            @endforeach

        </div>
        <div>

            <form action="{{ route('cart.addPickupTime', ['order' => $order->id]) }}" method="post">
                @csrf
                <div>
                    @if ($order->pickup_time)
                        <p id="pickup_time_value">Heure de récupération : {{ $order->pickup_time }}</p>
                        <button
                            class="bg-transparent hover:bg-yellow-500 text-black-700 font-semibold hover:text-white py-2 px-4 border border-yelllow-500 hover:border-transparent rounded"
                            id="modify_button">Modifier</button>
                    @else
                        <form id="pickup_time_form" action="{{ route('cart.addPickupTime', ['order' => $order->id]) }}"
                            method="post">
                            @csrf
                            <label for="pickup_time_input">Heure de récupération</label>
                            <input type="text" name="pickup_time" id="pickup_time_input"
                                value=""{{ old('pickup_time') ? old('pickup_time') : $order->pickup_time }}>
                            <button
                                class="bg-green hover:bg-green-500 text-noir-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
                                type="submit" id="add_button">Ajouter</button>
                        </form>
                    @endif
                </div>
            </form>
            @if ($order->pickup_time)
                @if ($order->mail_sent == 1)
                    <div class="bg-green-100 border-t border-b border-green-500 text-black -700 px-4 py-3"
                        role="alert">
                        <p class="font-bold">Commande confirmé</p>
                        <p class="text-sm"></p>
                    </div>
                @else
                    <form action="{{ route('cart.confirmOrder', ['order' => $order->id]) }}" method="get">
                        <button type="submit"
                            class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="w-3 h-3 text-white mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 16">
                                <path
                                    d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z" />
                                <path
                                    d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z" />
                            </svg>
                            Confimer
                        </button>
                    </form>
                @endif
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const pickupTimeValue = document.getElementById('pickup_time_value');
        const modifyButton = document.getElementById('modify_button');
        const pickupTimeForm = document.getElementById('pickup_time_form');

        if (pickupTimeValue && modifyButton && pickupTimeForm) {
            modifyButton.addEventListener('click', function() {
                pickupTimeValue.style.display = 'none';
                modifyButton.style.display = 'none';
                pickupTimeForm.style.display = 'block';
            });
        }
    });
</script>
