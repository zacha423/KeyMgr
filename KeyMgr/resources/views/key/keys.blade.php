@extends("adminlte::page")

{{-- Setup data for datatables --}}
@php
    $heads = [
        'ID',
        'Key Level',
        'Key System',
        'Copy Number',
        'Bitting',
        'Blind Code',
        'Main Angles',
        'Double Angles',
        'Replacement Cost',
        ['label' => 'Actions', 'no-export' => false, 'width' => 5],
    ];

    $config = [
        'data' => $keys,
        'order' => [[1, 'asc']],
        'columns' => [
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            null,
            ['orderable' => false]
        ],    
    ];
@endphp

@section('plugins.Datatables', true)
@section("content")
    <x-adminlte-datatable id="key-table" :heads="$heads" bordered compressed hoverable>
        @foreach($config['data'] as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            var keyId = $(this).data('key-id');
            if (confirm('Are you sure you want to delete this key?')) {
                $.ajax({
                    url: '/keys/' + keyId,
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

