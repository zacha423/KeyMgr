@extends('adminlte::page')

@section('title', 'Rooms in ' . $building['name'])

@section('content_header')
    <h1>Rooms in {{ $building['name'] }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                @foreach ($building['rooms'] as $room)
                    <li>
                        <a href="{{ route('room.show', ['room' => $room['id']]) }}">
                            {{ $room['number'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop