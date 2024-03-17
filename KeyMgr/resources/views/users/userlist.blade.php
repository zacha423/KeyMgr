@extends ("adminlte::page")
{{-- Setup data for datatables --}}
@extends('adminlte::page')
@php
$heads = [
    'ID',
    'First Name',
    'Last Name',
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$config = [
    'data' => $users,
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp
@section('content')
{{-- Minimal example / fill data using the component slot --}}

@section ("content")
<x-adminlte-datatable id="table1" :heads="$heads">
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>
@stop
