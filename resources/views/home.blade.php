<x-app-layout>

    <div class="slider-container">
        <div class="slider">
            <div class="slide bg-blue-500">
                <img src="/img/vinafood-burger.jpeg" >
            </div>
            <div class="slide bg-green-500 flex items-center justify-center">
                <img src="/img/vinafood-padthai.jpeg" >
            </div>
            <div class="slide bg-red-500">
                <img src="/img/vinafood-pizza.jpeg" >
            </div>
            <div class="slide bg-red-500">
                <img src="/img/vinafood-pizza.jpeg" >
            </div>
            <div class="slide bg-red-500">
                <img src="/img/vinafood-sushi.jpeg" >
            </div>
            <div class="slide bg-red-500">
                <img src="/img/vinafood-tiramisu.jpeg" >
            </div>
        </div>
        <div class="slider-text absolute top-0 left-0 w-full h-full flex items-center justify-center text-white text-center">
            <div class="space-y-11"> <!-- Add space-y class to create space between elements -->
                <h2 class="text-2xl font-semibold p-7">Bienvenue {{ Auth::user()->name }}</h2>
                <a href="{{ route('product.index') }}" class="focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Commander</a>
                @if ($favoriteProduct)
                <x-product-card :product="$favoriteProduct" />
            @elseif ($randomAvailableProduct)
                <x-product-card :product="$randomAvailableProduct" />
            @endif
            </div>
        </div>
        

    </div>


    <div>
        <h1>Les produits disponible aujourd'hui </h1>
    </div>

    <div class="flex overflow-hidden">
        <div class="flex-none w-64 bg-gray-100 p-4">
            <!-- Navigation buttons -->
            <button id="prevBtn" class="btn-prev">&lt;</button>
            <button id="nextBtn" class="btn-next">&gt;</button>
        </div>
        <div id="slider" class="flex overflow-x-scroll transition-transform duration-300">
            <!-- Product cards -->
            @foreach ($products as $product)
                <div class="w-64 bg-white p-4">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </div>





    @foreach ($favoriteProducts as $product)
        <div class="w-1/4 px-9">
            <x-product-card :product="$product" />
        </div>
    @endforeach

    <h1>Restaurant ouvert ce midi</h1>
    <div class="flex flex-wrap justify-center gap-9">
        @foreach ($restaurants as $restaurant)
            <x-restaurant-card :restaurant="$restaurant" :availableDays="$restaurant->availableDays" />
        @endforeach
    </div>



</x-app-layout>


<style>
    /* #slider::before,
#slider::after {
    content: "";
    position: absolute;
    top: 0;
    height: 100%;
    width: 50px;
    background: linear-gradient(90deg, rgba(255, 255, 255, 0), rgba(255, 255, 255, 1));
    pointer-events: none;
}

#slider::before {
    left: 0;
    box-shadow: 20px 0 20px -10px rgba(0, 0, 0, 0.3);
}

#slider::after {
    right: 0;
    box-shadow: -20px 0 20px -10px rgba(0, 0, 0, 0.3);
} */


    .slider-container {
        overflow: hidden;
        position: relative;
        width: 100%;
    }

    .slider {
        display: flex;
        transition: transform 1.5s ease-in-out;
    }

    .slide {
        flex: 0 0 100%;
        min-width: 100%;
        height: 800px;
        /* Adjust the height as needed */
    }
</style>







<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('slider');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const cardWidth = 280; // Adjust this to your card width including margins

        let position = 0;

        // Handle previous button click
        prevBtn.addEventListener('click', function() {
            if (position > 0) {
                position -= cardWidth;
                slider.style.transform = `translateX(-${position}px)`;
            }
        });

        // Handle next button click
        nextBtn.addEventListener('click', function() {
            const containerWidth = slider.offsetWidth;
            const totalWidth = slider.scrollWidth;

            if (position + containerWidth < totalWidth) {
                position += cardWidth;
                slider.style.transform = `translateX(-${position}px)`;
            }
        });
    });


    // Auto-play the slider
    const slider = document.querySelector('.slider');
    let slideIndex = 0;

    function showSlide(index) {
        slider.style.transform = `translateX(-${index * 100}%)`;
    }

    function autoPlay() {
        slideIndex = (slideIndex + 1) % slider.children.length;
        showSlide(slideIndex);
    }

    setInterval(autoPlay, 5000); 
</script>
