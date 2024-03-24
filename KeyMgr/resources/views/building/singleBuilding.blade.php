@extends('adminlte::page')

@section('title', __('Building Details'))

@section('content_header')
    <div class="p-2 flex justify-between items-center">
        <div class="flex items-center px-2">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mr-2">
                <span class="font-semibold text-xl">
                    <a href="{{ route('building.index') }}" class="text-black underline">Buildings</a> 
                    <i class="fas fa-long-arrow-alt-right text-gray-500 mx-2"></i> 
                    {{ $building['name'] }}
                </span>
            </h2>
        </div>
    </div>
@stop

@section('content')
    <div class="mb-4">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-4">
                <div class="bg-gray-200 p-4 rounded-md flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Number of Rooms</h2>
                        <p>{{ $numberOfRooms }}</p>
                    </div>
                    <div class="flex items-center">
                        <div class="ml-auto">
                            <a href="{{ route('building.buildingRooms',['building' => $building['id']]) }}" class="btn btn-primary">View All Rooms</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="bg-gray-100 p-4 rounded-md">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Street Address</h2>
                        @if(isset($building['streetAddress']))
                            <p>{{ $building['streetAddress'] }}</p>
                        @else
                            <p>Street Address information not available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="bg-gray-200 p-4 rounded-md">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Country</h2>
                        @if(isset($building['country']))
                            <p>{{ $building['country'] }}</p>
                        @else
                            <p>Country information not available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="bg-gray-300 p-4 rounded-md">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">State</h2>
                        @if(isset($building['state']))
                            <p>{{ $building['state'] }}</p>
                        @else
                            <p>State information not available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="bg-gray-400 p-4 rounded-md">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">City</h2>
                        @if(isset($building['city']))
                            <p>{{ $building['city'] }}</p>
                        @else
                            <p>City information not available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="bg-gray-500 p-4 rounded-md">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Postal Code</h2>
                        @if(isset($building['postalCode']))
                            <p>{{ $building['postalCode'] }}</p>
                        @else
                            <p>Postal Code information not available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4">
                    <div class="bg-gray-600 p-4 rounded-md">
                        <h2 class="text-lg font-bold text-gray-800 dark:text-gray-200">Campus Location</h2>
                        @if(isset($building['campus']))
                            <p>{{ $building['campus'] }}</p>
                        @else
                            <p>Campus information not available</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
