<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Buildings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
          @foreach($buildings as $building)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
              <div class="p-6 text-gray-900 dark:text-gray-100">
                <button type="button" onclick="window.location='{{ route('building.show', ['building' => $building['id']]) }}'">
                  {{ $building['name'] }}
                </button>
              </div>
            </div>
          @endforeach

        </div>
    </div>
</x-app-layout>
