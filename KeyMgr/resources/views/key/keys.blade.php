<x-app-layout>
  <x-slot name="header">
      <div class="p-2 flex justify-between items-center">
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
              {{ __('Keys') }}
          </h2>
          <button type="button" onclick="toggleNewKeyForm()" class="text-black">Add New Key</button>
      </div>

      <div id="newKeyFormModal" class="hidden fixed inset-0 z-10 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full sm:max-w-md">
                <div class="bg-white dark:bg-gray-800 p-6">
                    <form method="post" action="{{ route('key.store') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="keyLevel" class="block text-sm font-medium text-gray-700">Key Level</label>
                            <input type="text" id="keyLevel" name="keyLevel" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="keySystem" class="block text-sm font-medium text-gray-700">Key System</label>
                            <input type="text" id="keySystem" name="keySystem" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="copyNumber" class="block text-sm font-medium text-gray-700">Copy Number</label>
                            <input type="text" id="copyNumber" name="copyNumber" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="bitting" class="block text-sm font-medium text-gray-700">Key Bitting</label>
                            <input type="text" id="bitting" name="bitting" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="blindCode" class="block text-sm font-medium text-gray-700">Key Blind Code</label>
                            <input type="text" id="blindCode" name="blindCode" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="mainAngles" class="block text-sm font-medium text-gray-700">Key Main Angles </label>
                            <input type="text" id="mainAngles" name="mainAngles" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="doubleAngles" class="block text-sm font-medium text-gray-700">Key Double Angles </label>
                            <input type="text" id="doubleAngles" name="doubleAngles" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="mb-4">
                            <label for="replacementCost" class="block text-sm font-medium text-gray-700">Key Replacement Cost </label>
                            <input type="text" id="replacementCost" name="replacementCost" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="flex justify-end">
                            <button type="button" onclick="toggleNewBuildingForm()" class="text-gray-600 hover:text-gray-800 mr-2">Cancel</button>
                            <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded-md">Save Key</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>

      <script>
        function toggleNewKeyForm() {
          var modal = document.getElementById('newKeyFormModal');
          modal.classList.toggle('hidden', !modal.classList.contains('hidden'));
        }
      </script>
  </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          @foreach($keys as $key)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 flex justify-between items-center">
                    <div class="flex items-center">
                        <a href="{{ route('key.show', ['key' => $key['id']]) }}" class="block text-xl font-medium text-blue-600 mb-2">{{ $key['id'] }}</a>
                    </div>
                </div>
            </div>
          @endforeach
        </div>
    </div>
</x-app-layout>