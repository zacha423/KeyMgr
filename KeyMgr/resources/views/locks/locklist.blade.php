@extends('adminlte::page')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('title', 'List of Rooms')

@php
$heads = [
  'Lock ID',
  'Number of Pins',
  'Install Date',
  'Keyway',
  'Keyway ID',
  'Building',
  'Room',
  ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$config = [
  'data' => $data,
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
    <div class="d-flex justify-content-between align-items-center">
        <h1>List of Locks</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#newLockModal" disabled>New Lock</button>
    </div>
@stop

@section("content")

<x-adminlte-modal id="newLockModal" title="Add New Lock" theme="lightblue" size="sm1" v-centered static-backdrop scrollable>
    <form id="newLock" action="{{ route('locks.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="keyLevel">Key Level</label>
            <input type="text" class="form-control @error('keyLevel') is-invalid @enderror" id="keyLevel" name="keyLevel" value="{{ old('keyLevel') }}">
            @error('keyLevel')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>


        <x-slot name="footerSlot">
            <x-adminlte-button type="submit" class="block mr-auto" theme="success" label="Add Key" form="newLock"/>
            <x-adminlte-button type="button" class="block ml-auto" theme="danger" label="Cancel" data-dismiss="modal"/>
        </x-slot>
    </form>
</x-adminlte-modal>


@section('plugins.Datatables', true)
    <!-- Datatable -->
    <x-adminlte-datatable id="lock-table" :heads="$heads" bordered compressed hoverable>
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
            const lockId = $(this).data('key-id');
            if (confirm('Are you sure you want to delete this lock?')) {
                $.ajax({
                    url: '/locks/' + lockId,
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