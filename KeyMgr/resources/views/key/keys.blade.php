@extends("adminlte::page")

{{-- Setup data for datatables --}}
@php
    $heads = [
        'ID',
        'Key Level',
        'Key System',
        'Copy Number',
        'Bitting',
        'Replacement Cost',
        'Key Status',
        'Keyway',
        ['label' => 'Actions', 'no-export' => false, 'width' => 5],
    ];

    $config = [
        'data' => $keys,
        'order' => [[1, 'asc']],
        'columns' => [
            null,
            null,
            null,
            ['orderable' => false],
        ],    
    ];
@endphp

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>List of Keys</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#newKeyModal">New Key</button>
    </div>
@stop

@section("content")

<x-adminlte-modal id="newKeyModal" title="Add New Key" theme="lightblue" size="sm1" v-centered static-backdrop scrollable>
    <form id="newKey" action="{{ route('keys.store') }}" method="POST">
        @csrf

        {{-- Key Level field --}}
        <div class="form-group">
            <label for="keyLevel">Key Level</label>
            <input type="text" class="form-control @error('keyLevel') is-invalid @enderror" id="keyLevel" name="keyLevel" value="{{ old('keyLevel') }}">
            @error('keyLevel')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Key System field --}}
        <div class="form-group">
            <label for="keySystem">Key System</label>
            <input type="text" class="form-control @error('keySystem') is-invalid @enderror" id="keySystem" name="keySystem" value="{{ old('keySystem') }}">
            @error('keySystem')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Copy Number field --}}
        <div class="form-group">
            <label for="copyNumber">Copy Number</label>
            <input type="text" class="form-control @error('copyNumber') is-invalid @enderror" id="copyNumber" name="copyNumber" value="{{ old('copyNumber') }}">
            @error('copyNumber')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Replacement Cost field --}}
        <div class="form-group">
            <label for="replacementCost">Replacement Cost</label>
            <input type="number" class="form-control @error('replacementCost') is-invalid @enderror" id="replacementCost" name="replacementCost" step="0.01" min="0" value="{{ old('replacementCost') }}">
            @error('replacementCost')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Bitting field --}}
        <div class="form-group">
            <label for="bitting">Bitting</label>
            <input type="text" class="form-control @error('bitting') is-invalid @enderror" id="bitting" name="bitting" value="{{ old('bitting') }}">
            @error('bitting')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Key Status field --}}
        <div class="form-group">
            <label for="key_status_id">Key Status</label>
            <select class="form-control @error('key_status_id') is-invalid @enderror" id="key_status_id" name="key_status_id">
                <option value="" disabled selected>Select Key Status</option>
                @foreach($keyStatuses as $keyStatus)
                    <option value="{{ $keyStatus['id'] }}">{{ $keyStatus['name'] }}</option>
                @endforeach
            </select>
            @error('key_status_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        {{-- Keyway field --}}
        <div class="form-group">
            <label for="keyway_id">Keyway</label>
            <select class="form-control @error('keyway_id') is-invalid @enderror" id="keyway_id" name="keyway_id">
                <option value="" disabled selected>Select Keyway</option>
                @foreach($keyways as $keyway)
                    <option value="{{ $keyway['id'] }}">{{ $keyway['name'] }}</option>
                @endforeach
            </select>
            @error('keyway_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <x-slot name="footerSlot">
            <x-adminlte-button type="submit" class="block mr-auto" theme="success" label="Add Key" form="newKey"/>
            <x-adminlte-button type="button" class="block ml-auto" theme="danger" label="Cancel" data-dismiss="modal"/>
        </x-slot>
    </form>
</x-adminlte-modal>


@section('plugins.Datatables', true)
    <!-- Datatable -->
    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="key-table" :heads="$heads" bordered compressed hoverable>
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

            // Handle key deletion
            $('.btn-delete').click(function(e) {
                e.preventDefault();
                const keyId = $(this).data('key-id');
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
@stop