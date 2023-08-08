@props(['restaurant', 'availableDays'])

<div class="mx-auto container flex justify-center py-16 px-4">
    <div class="flex flex-col space-y-8 w-full px-16 max-w-xl">

        <!-- Image section -->
        <img src="https://images.unsplash.com/photo-1599481238640-4c1288750d7a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2664&q=80" alt="Your Image" class="object-cover w-full h-full rounded-xl" />

        <!-- Notification section -->
        <div class="relative">
            <div class="absolute right-10 flex space-x-2 items-start bg-white text-gray-900 border-gray-200 shadow-2xl -mt-16 w-96 py-3 rounded-lg">
                <div class="flex-initial">
                </div>

                    <div>
                        <h2 class="font-bold text-xl mb-2">{{ $restaurant->name}}</h2>
                        <p class="text-gray-700 text-base mb-3"> 📍{{ $restaurant->address }}, {{ $restaurant->cp}} {{ $restaurant->city}}</p>
                        <p class="text-gray-700 text-base">  📞 {{ $restaurant->phone }}</p>
                    </div>
                    <div class="flex-1 inline-flex flex-col items-end justify-start">
                        @foreach ($availableDays as $day)
                        <div class="inline-block bg-gray-200 rounded-full px-2 py-1 text-xs font-semibold text-gray-700 mr-2 mb-2">{{$day->day}}</div>
                        @endforeach
                    </div>
    
            </div>
        </div>
    </div>
</div>


