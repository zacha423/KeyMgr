@extends('adminlte::page')

@php
$heads = [
    'Room ID',
    'Room Number',
    'Description',
    'Building',
    'Door Description',
    'Door Hardware Description',
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];
$config = [
    'data' => $rooms,
    'order' => [[0, 'asc']],
    'columns' => [
        null,
        null,
        ['orderable' => false]
    ],
];
@endphp

@section('content_header')
    <h1>List of Rooms</h1>
@stop

@section("content")
    <x-adminlte-datatable id="room-table" :heads="$heads" bordered compressed hoverable>
        @foreach($config['data'] as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop


@section('js')
    <script>
        function deleteRoom(roomId) {
            // Implement your logic for deleting a room
            console.log("Delete room with ID: " + roomId);
        }
    </script>
@stop
