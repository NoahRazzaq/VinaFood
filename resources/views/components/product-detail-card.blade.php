@props(['product', 'users'])


<div class="group relative block overflow-hidden">
    <form method="POST" action="{{ route('favorite.store', $product->id) }}">
        @csrf
        <input type="hidden" name="is_liked" value="{{ $product->is_liked ? 0 : 1 }}">
        <button type="submit"
            class="absolute end-4 top-4 z-10 rounded-full bg-white p-1.5 text-gray-900 transition hover:text-gray-900/75">
            <span class="sr-only">Wishlist</span>

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="h-4 w-4 @if ($product->is_liked) fill-red-500 stroke-red-500 @endif">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
            </svg>
        </button>
    </form>
    <img src="{{ asset('/storage/' . $product->image) }}" alt=""
        class="h-64 w-full object-cover transition duration-500 group-hover:scale-105 sm:h-72" />

    <div class="relative border border-gray-100 bg-white p-6">
        <span class="whitespace-nowrap bg-yellow-400 px-3 py-1.5 text-xs font-medium">
            {{ $product->restaurant->name }}
        </span>

        <h3 class="mt-4 text-lg font-medium text-gray-900">{{ $product->name }}</h3>

        <p class="mt-1.5 text-sm text-gray-700">{{ $product->price }}€</p>

        <p class="mt-1.5 text-sm text-gray-700">
            {{ $product->detail }}
        </p>

        <form method="POST" action="{{ route('cart.store', $product->id) }}">
            @csrf
            <input type="number" min="1" placeholder="Votre quantité" name="quantity" id="quantity">
            @error('quantity')
                <div class="flex items-center p-2 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div>
                        <span class="font-medium">{{ $message }} </span>
                    </div>
                </div>
            @enderror
            <select name="user_id" id="user_id">
                @foreach ($users as $user)
                    <option value={{ $user->id }} @selected($user->id == Auth::user()->id)> {{ $user->name }}</option>
                @endforeach
            </select>
            <button type="submit"
                class="block w-full rounded bg-yellow-400 p-4 text-sm font-medium transition hover:scale-105">

                Commander
            </button>
        </form>
    </div>
</div>
