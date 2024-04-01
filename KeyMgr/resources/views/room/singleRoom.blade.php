@extends('adminlte::page')

@section('title', 'Room Details')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Room Details</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('room.index') }}">All Rooms</a></li>
                <li class="breadcrumb-item active">Room {{ $room['id'] }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h2 class="card-title"><strong>Room Number:</strong> {{ $room['number'] }}</h2>
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
                        <p><strong>Description:</strong> @if(isset($room['description'])){{ $room['description'] }}@else Description not available @endif</p>
                        <p><strong>Building:</strong> @if(isset($room['building_id'])){{ $room['building']->name }}@else Building not available @endif</p>
                        <p><strong>Door Description:</strong> @if(isset($room['id'])){{ optional($door)->description ?: 'Not available' }}@else Door information not available @endif</p>
                        <p><strong>Door Hardware:</strong> @if(isset($room['id'])){{ optional($door)->hardwareDescription ?: 'Not available' }}@else Door information not available @endif</p>
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
