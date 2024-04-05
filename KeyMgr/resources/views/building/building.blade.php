@extends('adminlte::page')
   {{-- Setup data for datatables --}}
@php
$heads = [
    'ID',
    'Building Name',
    'Country',
    'State',
    'City',
    'Postal Code',
    'Street Address',
    'Campus',
    ['label' => 'Actions', 'no-export' => false, 'width' => 5],
];
$config = [
    'data' => $buildings,
    'order' => [[1, 'asc']],
    'columns' => [
        null,
        null,
        null,
        ['orderable' => false]
    ],
];
@endphp

@section('content_header')
    <h1>List of Buildings</h1>
@stop
@section('plugins.Datatables', true)
@section("content")
    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="building-table" :heads="$heads" bordered compressed hoverable>
                @foreach($config['data'] as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            </x-adminlte-datatable>
        </div>
    </div>
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const buildingId = $(this).data('key-id');
            console.log('Building ID:', buildingId);
            if (confirm('Are you sure you want to delete this building?')) {
                $.ajax({
                    url: '/building/' + buildingId,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert('An error occurred while deleting the building.');
                    }
                });
            }
        });
    });
</script>

