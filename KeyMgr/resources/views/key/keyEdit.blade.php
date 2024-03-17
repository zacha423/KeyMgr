<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Key') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6">
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
                            <input type="number" id="copyNumber" name="copyNumber" class="mt-1 p-2 border rounded-md w-full" required>
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
                            <input type="number" id="replacementCost" name="replacementCost" class="mt-1 p-2 border rounded-md w-full" required>
                        </div>

                        <div class="flex justify-end">
                            <a href="{{ route('keys.index') }}" class="text-gray-600 hover:text-gray-800 mr-2">Cancel</a>
                            <button type="submit" class="bg-green-500 text-black px-4 py-2 rounded-md">Save Key</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
