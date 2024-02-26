<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Building Information') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ $building['name'] }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>



<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Information</title>
</head>
<body>
    <div class="container">
        <h1>Building Information</h1>
        @include('campus.addressShow')
        <a href="{{ route('campus.edit', ['campus' => $campus['id']]) }}">{{ "Edit" }}</a>
    </div>
</body>
</html> -->