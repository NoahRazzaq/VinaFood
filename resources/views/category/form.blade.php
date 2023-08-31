<x-app-layout>
    <x-slot name="header">
            <h2 class="font-semibold text-3xl text-gray-800 leading-tight flex justify-center items-center">
                Ajouter une catégorie
            </h2>
    </x-slot>

    <div class="flex items-center justify-center h-full">

    <form method="POST" action="/categories/store" class="space-y-10 w-full max-w-md">
    @csrf
    <div class="mb-6">
      <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Nom</label>
      <input type="text" id="name" name="name" class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  dark:border-gray-600 dark:placeholder-gray-400  dark:focus:ring-blue-500 dark:focus:border-blue-500"
      placeholder="sandwich poulet">
      @error('name')
      <div style="width:100%">
          {{$message}}
      </div>
      @enderror
    </div>

    <button type="submit"
    class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2 dark:border-green-500 dark:text-green-500 dark:hover:text-white dark:hover:bg-green-600 dark:focus:ring-green-800">Ajouter</button>

    </form>
    </div>

</x-app-layout>