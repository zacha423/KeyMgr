<x-app-layout>
  <x-slot name="header">
      <div class="p-2 flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              {{ __('Buildings') }}
          </h2>
          <button type="button" onclick="toggleNewBuildingForm()" class="text-black">Add New Building</button>
      </div>
      <!-- New building form modal -->
      <div id="newBuildingFormModal" class="hidden fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- Modal content -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-md">
                <div class="bg-white dark:bg-gray-800 p-6">
                    <form method="post" action="{{ route('building.store') }}">
                        @csrf
                        <!-- Add your form fields here, e.g., name, country, etc. -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Building Name</label>
                            <input type="text" id="name" name="name" class="mt-1 p-2 border rounded-md w-full" required>
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
          modal.classList.toggle('hidden');
      }

      // Close the modal when clicking outside the modal content
      document.addEventListener('click', function (event) {
          var modal = document.getElementById('newBuildingFormModal');
          if (event.target === modal) {
              toggleNewBuildingForm();
          }
      });
  </script>

  </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

           
        @foreach($buildings as $building)
          <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
              <div class="p-6 flex justify-between items-center">
                  <div class="flex items-center">
                      <button type="button" onclick="toggleDropdown('{{ $building['id'] }}')">
                          {{ $building['name'] }}
                      </button>
                  </div>
                  <div class="flex items-center">
                      <a href="{{ route('building.edit', ['building' => $building['id']]) }}" class="ml-auto flex items-center p-2 bg-gray-200 dark:bg-gray-600 rounded-md">
                          <svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                          </svg>
                      </a>
                  </div>
              </div>
              <div id="dropdown-{{ $building['id'] }}" class="hidden p-6">

    
              </div>
          </div>
      @endforeach

      <script>
          function toggleDropdown(buildingId) {
              document.querySelectorAll('[id^="dropdown-"]').forEach(function (dropdown) {
                  dropdown.classList.add('hidden');
              });

              var dropdown = document.getElementById('dropdown-' + buildingId);
              dropdown.classList.toggle('hidden');
          }
      </script>

        </div>
    </div>
</x-app-layout>

@if(isset($buildingsJSON))
<h2>buildings/buildingsJSON</h2>
{{$buildingsJSON}}
@endif
@if(isset($buildingJSON))
<h2>building/buildingJSON</h2>
{{ $buildingJSON }}
@endif
@if(isset($campusJSON))
<h2>campus/campusJSON</h2>
{{$campusJSON}}
@endif

<!-- Add a serach feature for buildings / rooms -->