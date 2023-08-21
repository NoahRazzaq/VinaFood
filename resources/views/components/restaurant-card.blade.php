@props(['restaurant', 'availableDays'])

<a href="{{ route('restaurant.show', ['restaurant' => $restaurant->id]) }}" class="max-w-sm rounded overflow-hidden shadow-lg">
    <img class="w-full" src="https://images.unsplash.com/photo-1599481238640-4c1288750d7a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2664&q=80" alt="Sunset in the mountains">
    <div class="px-6 py-4">
        <div class="font-bold text-xl mb-2">{{ $restaurant->name }}</div>
        <p class="text-gray-700 text-base">
            📍{{ $restaurant->address }}, {{ $restaurant->cp}} {{ $restaurant->city}}
        </p>
        <br>
        <p class="text-gray-700 text-base">
            📞 {{ $restaurant->phone }}
        </p>
    </div>
    <div class="px-6 pt-4 pb-2">
        @foreach ($availableDays as $day)
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $day->day }}</span>
        @endforeach
    </div>
</a>
