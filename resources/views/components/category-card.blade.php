@props(['category'])

<a href="{{ route('category.show', ['id' => $category->id]) }}" class="border-2 rounded-lg border-yellow-500 font-bold text-yellow-500 px-4 py-3 transition duration-300 ease-in-out hover:bg-yellow-500 hover:text-black mr-6">
    {{ $category->name }}
</a>