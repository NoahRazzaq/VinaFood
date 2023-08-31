<x-app-layout>

    <div class="slider-container">
        <div class="slider">
            <div class="slide bg-blue-500">
                <img src="/img/vinafood-burger.jpeg">
            </div>
            <div class="slide bg-green-500 flex items-center justify-center">
                <img src="/img/vinafood-padthai.jpeg">
            </div>
            <div class="slide bg-red-500">
                <img src="/img/vinafood-pizza.jpeg">
            </div>
            <div class="slide bg-red-500">
                <img src="/img/vinafood-pizza.jpeg">
            </div>
            <div class="slide bg-red-500">
                <img src="/img/vinafood-sushi.jpeg">
            </div>
            <div class="slide bg-red-500">
                <img src="/img/vinafood-tiramisu.jpeg">
            </div>
        </div>
        <div
            class="slider-text absolute top-0 left-0 w-full h-full flex items-center justify-center text-white text-center">
            <div class="space-y-11">
                <h2 class="text-2xl font-semibold p-7">Bienvenue {{ Auth::user()->name }}</h2>
                <a href="{{ route('product.index') }}"
                    class="focus:outline-none text-black bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:focus:ring-yellow-900">Commander</a>
                @if ($favoriteProduct)
                    <x-product-card :product="$favoriteProduct" />
                @elseif ($randomAvailableProduct)
                    <x-product-card :product="$randomAvailableProduct" />
                @endif
            </div>
        </div>


    </div>


    <div class="p-20">
        <h1 class="font-semibold text-3xl text-gray-800 text-center">Les produits disponible aujourd'hui</h1>
    </div>
    
    @if ($products->isEmpty())
        <div>
            <h2 class="font-semibold text-3xl text-gray-800 text-center">Pas de produits disponibles pour aujourd'hui</h2>
            <div class="custom-slider-container relative">
                <div class="custom-slider flex">
                    @foreach ($randomProducts as $product)
                        <div class="custom-slide">
                            <x-product-card :product="$product" />
                        </div>
                    @endforeach
                </div>
                <button class="custom-slider-button prev" onclick="slide('prev')">Previous</button>
                <button class="custom-slider-button next" onclick="slide('next')">Next</button>
            </div>
        </div>
    @else
        <div class="custom-slider-container relative">
            <div class="custom-slider flex">
                @foreach ($products as $product)
                    <div class="custom-slide">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
            <button class="custom-slider-button prev" onclick="slide('prev')">Previous</button>
            <button class="custom-slider-button next" onclick="slide('next')">Next</button>
        </div>
    @endif


    @if ($restaurants->isEmpty())
    <h1 class="font-semibold text-3xl text-gray-800 text-center">Des Restaurants</h1>
    <div class="flex flex-wrap justify-center gap-9">
        @foreach ($randomRestaurants as $restaurant)
            <x-restaurant-card :restaurant="$restaurant" :availableDays="$restaurant->availableDays" />
        @endforeach
    </div>
    @else
    <h1 class="font-semibold text-3xl text-gray-800 text-center">Restaurants ouvert ce midi</h1>
    <div class="flex flex-wrap justify-center gap-9">
        @foreach ($restaurants as $restaurant)
            <x-restaurant-card :restaurant="$restaurant" :availableDays="$restaurant->availableDays" />
        @endforeach
    </div>
    @endif
    
    

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
    }

    .custom-slider-container {
        overflow: hidden;
        position: relative;
        width: 100%;
    }

    .custom-slider {
        display: flex;
        transition: transform 1.5s ease-in-out;
    }

    .custom-slide {
        flex: 0 0 calc(33.33% - 20px); /* Adjust the width and margin as needed */
        margin-right: 20px;
        min-width: 100%;
        height: 800px;
        /* Adjust the styles as needed */
    }

    .custom-slider-button {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        padding: 8px 16px;
        background-color: #333;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .custom-slider-button.prev {
        left: 0;
    }

    .custom-slider-button.next {
        right: 0;
    }

   
</style>



<script>
    // header slider autoplay
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



    // slider products

    let currentCustomSlide = 0;
    const customSlideWidth = document.querySelector('.custom-slide').clientWidth;
    const customSlides = document.querySelectorAll('.custom-slide');

    function slide(direction) {
        if (direction === 'prev') {
            currentCustomSlide = Math.max(currentCustomSlide - 1, 0);
        } else if (direction === 'next') {
            currentCustomSlide = Math.min(currentCustomSlide + 1, customSlides.length - 1);
        }

        const translateValue = -currentCustomSlide * customSlideWidth;
        document.querySelector('.custom-slider').style.transform = `translateX(${translateValue}px)`;
    }
</script>
