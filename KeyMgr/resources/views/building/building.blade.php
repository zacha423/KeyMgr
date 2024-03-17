<x-app-layout>
  <x-slot name="header">
      <div class="p-2 flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              {{ __('Buildings') }}
          </h2>
          <button type="button" onclick="toggleNewBuildingForm()" class="text-black">Add New Building</button>
      </div>

      <div id="newBuildingFormModal" class="hidden fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-md">
                <div class="bg-white dark:bg-gray-800 p-6">
                    <form method="post" action="{{ route('building.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Building Name</label>
                            <input type="text" id="name" name="name" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="streetAddress" class="block text-sm font-medium text-gray-700">Street Address</label>
                            <input type="text" id="streetAddress" name="streetAddress" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                            <input type="text" id="city" name="city" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                            <input type="text" id="state" name="state" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                            <input type="text" id="country" name="country" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="postalCode" class="block text-sm font-medium text-gray-700">Postal Code</label>
                            <input type="text" id="postalCode" name="postalCode" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                          <label for="campus" class="block text-sm font-medium text-gray-700">Campus</label>
                          <select id="campus" name="campus" class="mt-1 p-2 border rounded-md w-full" required>
                              <option value="" disabled selected>Select a Campus</option>
                              @foreach($campuses as $campus)
                                  <option value="{{ $campus['id'] }}">{{ $campus['name'] }}</option>
                              @endforeach
                          </select>
                      </div>

                        <div class="flex justify-end">
                            <button type="button" onclick="toggleNewBuildingForm()" class="text-gray-600 hover:text-gray-800 mr-2">Cancel</button>
                            <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded-md">Save Building</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>

      <script>
        function toggleNewBuildingForm() {
          var modal = document.getElementById('newBuildingFormModal');
          modal.classList.toggle('hidden', !modal.classList.contains('hidden'));
        }
      </script>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach($buildings as $building)
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
            <div class="p-6 flex justify-between items-center">
                <div class="flex items-center">
                    <a href="{{ route('building.show', ['building' => $building['id']]) }}" class="block text-xl font-medium text-blue-600 mb-2">{{ $building['name'] }}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
  </div>

</x-app-layout>
