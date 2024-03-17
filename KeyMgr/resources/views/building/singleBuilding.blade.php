<x-app-layout>
  <x-slot name="header">
      <div class="p-2 flex justify-between items-center">
          <div class="flex items-center px-2">
              <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mr-2">
                {{ $building['name'] }}
              </h2>

              <a href="{{ route('building.edit', ['building' => $building['id']]) }}" 
                class="flex items-center p-2 bg-gray-200 dark:bg-gray-600 rounded-md">
                  <svg class="feather feather-edit" fill="none" height="24" stroke="currentColor" 
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" 
                      width="24" xmlns="http://www.w3.org/2000/svg">
                      <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
                      <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
                  </svg>
              </a>
          </div>

          <button 
              onclick="confirmDelete('{{ $building['id'] }}')" 
              class="flex items-center p-2 bg-red-500 hover:bg-red-600 dark:bg-red-600 dark:hover:bg-red-700 rounded-md ml-auto">
              <svg class="feather feather-trash-2" fill="none" height="24" stroke="currentColor" 
                  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" 
                  width="24" xmlns="http://www.w3.org/2000/svg">
                  <path d="M3 6l3-3h12a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6zm5 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M10 11v7M14 11v7"/>
              </svg>
          </button>
      </div>
  </x-slot>

  <script>
      function confirmDelete(buildingID) {
          if (confirm("Are you sure you want to delete this room?")) {
              window.location.href = "{{ route('building.destroy', ['building' => $building['id']]) }}" + "/" + roomId;
          }
      }
  </script>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
                    <div class="mb-4">
                      @if(isset($building['streetAddress']))
                          <p>Street Address: {{ $building['streetAddress'] }}</p>
                      @else
                          <p>Street Address information not available</p>
                      @endif
                    </div>

                    <div class="mb-4">
                      @if(isset($building['country']))
                          <p>Country: {{ $building['country'] }}</p>
                      @else
                          <p>Country information not available</p>
                      @endif
                    </div>

                    <div class="mb-4">
                      @if(isset($building['state']))
                        <p>State: {{ $building['state'] }}</p>
                      @else
                          <p>State information not available</p>
                      @endif
                    </div>

                    <div class="mb-4">
                      @if(isset($building['country']))
                          <p>Country: {{ $building['country'] }}</p>
                      @else
                          <p>Country information not available</p>
                      @endif
                    </div>
                    <div class="mb-4">
                      @if(isset($building['city']))
                          <p>City: {{ $building['city'] }}</p>
                      @else
                          <p>City information not available</p>
                      @endif
                    </div>

                    <div class="mb-4">
                      @if(isset($building['postalCode']))
                        <p>Postal Code: {{ $building['postalCode'] }}</p>
                      @else
                          <p>Postal Code information not available</p>
                      @endif
                    </div>

                    <div class="mb-4">
                      @if(isset($building['campus']))
                          <p>Campus Location: {{ $building['campus'] }}</p>
                      @else
                          <p>Campus information not available</p>
                      @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
