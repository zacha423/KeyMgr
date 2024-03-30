@extends('adminlte::page')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('title', 'List of Rooms')

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

<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const userId = $(this).data('key-id');
            if (confirm('Are you sure you want to delete this room?')) {
                $.ajax({
                    url: '/room/' + userId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'DELETE'
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@stop