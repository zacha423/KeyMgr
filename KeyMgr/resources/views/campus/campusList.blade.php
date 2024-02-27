<x-app-layout>
  <x-slot name="header">
      <div class="p-2 flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              {{ __('Campuses') }}
          </h2>
          <button type="button" onclick="toggleNewCampusForm()" class="p-6 text-gray-900 dark:text-gray-100">Add New Campus</button>
      </div>
      <!-- New campus form modal -->
      <div id="newCampusFormModal" class="hidden fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal content -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-md">
                <div class="bg-white dark:bg-gray-800 p-6">
                    <form method="POST" action="{{ route('campus.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Campus Name</label>
                            <input type="text" id="name" name="name" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Country</label>
                            <input type="text" id="country" name="country" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-100">State</label>
                            <input type="text" id="state" name="state" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-100">City</label>
                            <input type="text" id="City" name="city" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Street</label>
                            <input type="text" id="Street" name="streetAddress" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-900 dark:text-gray-100">Zip Code</label>
                            <input type="text" id="Zip" name="postalCode" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        <div class="flex justify-end">
                            <button type="button" onclick="toggleNewCampusForm()" class="text-gray-600 hover:text-gray-800 mr-2">Cancel</button>
                            <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded-md">Save Campus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>

  <script>
      function toggleNewCampusForm() {
          var modal = document.getElementById('newCampusFormModal');
          modal.classList.toggle('hidden');
      };
  </script>

  </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          @foreach($campuses as $campus)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <div class="flex items-center">
                        <button type="button" onclick="toggleDropdown('{{ $campus['id'] }}')">
                            {{ $campus['name'] }}
                        </button>
                    </div>
                    <div class="flex items-center">
                        <a href="{{ route('campus.edit', ['campus' => $campus['id']]) }}" class="ml-auto flex items-center p-2 bg-gray-200 dark:bg-gray-600 rounded-md">
                            <svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div id="dropdown-{{ $campus['id'] }}" class="hidden p-6">

      
                </div>
            </div>
          @endforeach

          <script>
              function toggleDropdown(campusId) {
                  document.querySelectorAll('[id^="dropdown-"]').forEach(function (dropdown) {
                      dropdown.classList.add('hidden');
                  });

                  var dropdown = document.getElementById('dropdown-' + campusId);
                  dropdown.classList.toggle('hidden');
              }
          </script>

        </div>
    </div>
</x-app-layout>

