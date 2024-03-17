<x-app-layout>
  <x-slot name="header">
      <div class="p-2 flex justify-between items-center">

          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              Room Number: {{ $room['number'] }}
           </h2>
      </div>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
              <div class="p-6 flex justify-between items-center">
                <div class="flex items-center">
                @if(isset ($room['description']))
                      <p class="mb-2">Description: {{ $room['description'] }}</p>
                  @else
                      <p class="mb-2">Description not available</p>
                  @endif

                </div>
                <div class="flex items-center">
                  @if(isset ($room['building_id']))
                        <p class="mb-2">Building: {{ $room['building']->name }}</p>
                    @else
                        <p class="mb-2">Building not available</p>
                    @endif
                </div>

                <div class="flex items-center">
                  @if(isset ($room['door_id']))
                        <p class="mb-2">Door: {{ $room['door']->description }}</p>
                        <p class="mb-2">Door Hardware: {{ $room['door']->hardwareDescription }}</p>
                    @else
                        <p class="mb-2">Door not available</p>
                    @endif
                </div>

                <div class="flex items-center">
                  <a href="{{ route('room.edit', ['room' => $room['id']]) }}" class="ml-auto flex items-center p-2 bg-gray-200 dark:bg-gray-600 rounded-md">
                      <svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                          <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                      </svg>
                  </a>
                </div>
              </div>
            </div>
    </div>
  </div>
</x-app-layout>