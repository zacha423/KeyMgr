<x-app-layout>
  <x-slot name="header">
      <div class="p-2 flex justify-between items-center">

          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              {{ __('All Rooms') }}
          </h2>
          <button type="button" onclick="toggleNewRoomForm()" class="bg-sky-500 text-black rounded-md py-1 px-1"> Add New Room </button>
      </div>

      <div id="newRoomFormModal" class="hidden fixed inset-0 z-10 overflow-y-auto">
      <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
          <div class="fixed inset-0 transition-opacity" aria-hidden="true">
              <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
          </div>
          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
          <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-md">
              <div class="bg-white dark:bg-gray-800 p-6">
                  <form method="post" action="{{ route('room.store') }}">
                      @csrf
                      
                      <div class="mb-4">
                          <label for="number" class="block text-sm font-medium text-gray-700">Room Number</label>
                          <input type="text" id="number" name="number" class="mt-1 p-2 border rounded-md w-full" required>
                      </div>

                      <div class="mb-4">
                          <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                          <input type="text" id="description" name="roomDesc" class="mt-1 p-2 border rounded-md w-full" required>
                      </div>

                      <div class="mb-4">
                          <label for="building" class="block text-sm font-medium text-gray-700">Select Building</label>
                          <select id="building" name="building" class="mt-1 p-2 border rounded-md w-full" required>
                              <option value="" disabled selected>Select a building</option>
                              @foreach($buildings as $building)
                                  <option value="{{ $building['id'] }}">{{ $building['name'] }}</option>
                              @endforeach
                          </select>
                      </div>

                      <div class="mb-4">
                          <label for="doorDesc" class="block text-sm font-medium text-gray-700">Door Description</label>
                          <input type="text" id="doorDesc" name="doorDesc" class="mt-1 p-2 border rounded-md w-full" required>
                      </div>

                      <div class="mb-4">
                          <label for="doorHWDesc" class="block text-sm font-medium text-gray-700">Door Hardware Description</label>
                          <input type="text" id="doorHWDesc" name="doorHWDesc" class="mt-1 p-2 border rounded-md w-full" required>
                      </div>

                      <div class="flex justify-end">
                          <button type="button" onclick="toggleNewRoomForm()" class="text-gray-600 hover:text-gray-800 mr-2">Cancel</button>
                          <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded-md">Save Room</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
    </div>

    <script>
      function toggleNewRoomForm() {
        var modal = document.getElementById('newRoomFormModal');
        modal.classList.toggle('hidden', !modal.classList.contains('hidden'));
      }
    </script>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          @foreach($rooms as $room)
              <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 flex items-center">
                  <div class="flex items-center">
                      <a href="{{ route('room.show', ['room' => $room['id']]) }}" class="block text-xl font-medium text-blue-600 mb-2">{{ $room['number'] }}</a>                      <div class="text-center">
                          @if(isset ($room['description']))
                              <p class="mb-2">Description: {{ $room['description'] }}</p>
                          @else
                              <p class="mb-2">Description not available</p>
                          @endif
                          @if(isset ($room['buildingID']))
                              <p class="mb-2">Building: {{ $room['buildingName'] }}</p>
                          @else
                              <p class="mb-2">Building not available</p>
                          @endif
                      </div>
                  </div>
                </div>
              </div>
          @endforeach
      </div>
  </div>
</x-app-layout>