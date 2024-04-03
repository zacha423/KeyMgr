@extends('adminlte::page')
@section('title', 'test')
@section('content_header')
@stop
@section('content')
<div class="row">
  <button class="btn btn-primary" data-toggle="collapse" href="#lock">Locks Toggle</button>
  <button class="btn btn-primary" data-toggle="collapse" href="#build">Buildings Toggle</button>
  <button class="btn btn-primary" data-toggle="collapse" href="#keyway">Keyways Toggle</button>
  <button class="btn btn-primary" data-toggle="collapse" href="#models">Lock Models Toggle</button>
</div>
<div class="collapse" id="lock">
{{var_dump ($locks)}}
</div>
<div class="collapse" id="build">
{{var_dump ($buildings)}}
</div>
<div class="collapse" id="keyway">
{{var_dump ($keyways)}}
</div>
<div class="collapse" id="models">
{{var_dump ($models)}}
</div>
@stop



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('title', 'List of Rooms')

@php
$heads = [
  'Lock ID',
  'Room',
  'Building',
  'Keyway',
  'Install Date',
  ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$config = [
  'data' => $locks,
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
    <h1>List of Locks</h1>
@stop

@section('plugins.Datatables', true)
@section("content")
<div class="card">
    <div class="card-body">
        <x-adminlte-datatable id="lock-table" :heads="$heads" bordered compressed hoverable>
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
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const lockId = $(this).data('key-id');
            if (confirm('Are you sure you want to delete this lock?')) {
                $.ajax({
                    url: '/lock/' + lockId,
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