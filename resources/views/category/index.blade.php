<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight">
            Les catégories
        </h2>
    </x-slot>

    <div class="flex justify-center">
        @foreach ($categories as $category)
            <x-category-card :category="$category" />
        @endforeach
    </div>

</x-app-layout>
