@extends ("adminlte::page")
{{-- Setup data for datatables --}}
@php
$heads = [
    'ID',
    'First Name',
    'Last Name',
    'Email',
    ['label' => 'Actions', 'no-export' => false, 'width' => 5],
];

$config = [
    'data' => $users,
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp
{{-- Minimal example / fill data using the component slot --}}

@section('plugins.Datatables', true)
@section ("content")
<x-adminlte-datatable id="table5" :heads="$heads" bordered compressed hoverable>
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>
@stop
