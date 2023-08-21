@props(['product'])

<div class="max-w-md">
    <a href="{{ route('product.show', ['product' => $product->id]) }}" class="relative flex flex-col md:flex-row md:space-x-5 space-y-3 md:space-y-0 rounded-xl shadow-lg p-3 border border-white bg-white transition">
        <div class="w-full md:w-1/3 bg-white grid place-items-center">
            <img src="https://images.pexels.com/photos/4381392/pexels-photo-4381392.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500" alt="tailwind logo" class="rounded-xl" />
        </div>
        <div class="w-full md:w-2/3 bg-white flex flex-col space-y-2 p-3">
            <h3 class="font-bold text-xl">{{ $product->name }}</h3>
            <p class="text-gray-700 text-base">{{ $product->price }}€</p>
            <p class="text-gray-700 text-base"> {{ \Illuminate\Support\Str::limit($product->detail, 60, '...') }}</p>
        </div>
    </a>
</div>


