@extends('adminlte::page')

@section('title', 'Rooms in ' . $building->name)

@section('content_header')
    <h1>Rooms in {{ $building->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                @foreach ($building->rooms as $room)
                    <li>{{ $room->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@stop