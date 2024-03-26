@extends('adminlte::page')

@section('title', 'List of Rooms')

@php
$heads = [
    'Room ID',
    'Room Number',
    'Description',
    'Building',
    'Building Name',
    'Door Description',
    'Door Hardware Description',
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];
$config = [
    'data' => $rooms,
    'order' => [1, 'asc'],
    'columns' => [
        null,
        null,
        null,
        ['orderable' => false]
    ],
];
@endphp

@section('content_header')
    <h1>List of Rooms</h1>
@stop

@section('plugins.Datatables', true)
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