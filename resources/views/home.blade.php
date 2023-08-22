<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bienvenue {{ Auth::user()->name }}
        </h2>
    </x-slot>


    <div>
        <h1>Les produits disponible aujourd'hui </h1>
    </div>

    <div class="w-full overflow-hidden">
        <div class="flex" id="carousel">
            @foreach ($products as $product)
                <div class="w-1/4 px-9">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </div>
    
    <div class="flex justify-between mt-4">
        <button id="prevBtn" class="px-2 py-1 bg-gray-300">Précédent</button>
        <button id="nextBtn" class="px-2 py-1 bg-gray-300">Suivant</button>
    </div>

    
    
@foreach ($favoriteProducts as $product)
<div class="w-1/4 px-9">
<x-product-card :product="$product" />
</div>
    
@endforeach


<div></div>



</x-app-layout>

<script>
    const carousel = document.getElementById('carousel');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const cardWidth = carousel.firstElementChild.clientWidth;
    const visibleCards = 4; // Nombre de cartes visibles à la fois
    const step = cardWidth * visibleCards;

    let translateX = 0;

    prevBtn.addEventListener('click', () => {
        if (translateX < 0) {
            translateX += step;
            carousel.style.transform = `translateX(${translateX}px)`;
        }
    });

    nextBtn.addEventListener('click', () => {
        const maxTranslateX = -(carousel.scrollWidth - carousel.clientWidth);
        if (translateX > maxTranslateX) {
            translateX -= step;
            carousel.style.transform = `translateX(${translateX}px)`;
        }
    });
</script>


