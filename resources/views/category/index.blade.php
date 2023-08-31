<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

        <h2 class="font-semibold text-3xl text-gray-800 text-center leading-tight items-center">
            Les catégories
        </h2>
        <div class="space-x-4">
            <a href="{{ route('category.create') }}" class="text-blue-600 hover:text-blue-800 text-right">Ajouter une catégorie</a>
        </div>
        </div>
    </x-slot>

    <div class="flex justify-center">
        @foreach ($categories as $category)
            <x-category-card :category="$category" />
        @endforeach
    </div>

</x-app-layout>
