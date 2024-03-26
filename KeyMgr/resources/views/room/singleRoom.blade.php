@extends('adminlte::page')

@section('title', 'Room Details')

@section('content_header')
    <h1>Room Details</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Room Number: {{ $room['number'] }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('room.edit', ['room' => $room['id']]) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button onclick="confirmDelete('{{ $room['id'] }}')" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            @if(isset($room['description']))
                                <p class="mb-2">Description: {{ $room['description'] }}</p>
                            @else
                                <p class="mb-2">Description not available</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            @if(isset($room['building_id']))
                                <p class="mb-2">Building: {{ $room['building']->name }}</p>
                            @else
                                <p class="mb-2">Building not available</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            @if(isset($room['id']))
                                <p class="mb-2">Door Description: {{ optional($door)->description ?: 'Not available' }}</p>
                                <p class="mb-2">Door Hardware: {{ optional($door)->hardwareDescription ?: 'Not available' }}</p>
                            @else
                                <p class="mb-2">Door information not available</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        function confirmDelete(roomId) {
            if (confirm("Are you sure you want to delete this room?")) {
                window.location.href = "{{ route('room.destroy', ['room' => $room['id']]) }}" + "/" + roomId;
            }
        }
    </script>
@stop
