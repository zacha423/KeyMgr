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
        'order' => [[0, 'asc']],
        'columns' => [
            null,
            null,
            null,
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

@section('plugins.Datatables', true)
@section("content") 
<div class="modal fade" id="newKeyModal" tabindex="-1" role="dialog" aria-labelledby="newKeyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newKeyModalLabel">Add New Key</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="newKeyForm">
                        <div class="form-group">
                            <label for="keyLevel">Key Level</label>
                            <input type="text" class="form-control" id="keyLevel" name="keyLevel">
                        </div>

                        <div class="form-group">
                            <label for="keySystem">Key System</label>
                            <input type="text" class="form-control" id="keySystem" name="keySystem">
                        </div>

                        <div class="form-group">
                            <label for="copyNumber">Copy Number</label>
                            <input type="text" class="form-control" id="copyNumber" name="copyNumber">
                        </div>

                        <div class="form-group">
                            <label for="replacementCost">Replacement Cost</label>
                            <input type="number" class="form-control" id="replacementCost" name="replacementCost" step="0.01" min="0">
                        </div>

                        <div class="form-group">
                            <label for="bitting">Bitting</label>
                            <input type="text" class="form-control" id="bitting" name="bitting">
                        </div>

                        <div class="form-group">
                            <label for="key_status_id">Key Status</label>
                            <select class="form-control" id="key_status_id" name="key_status_id">
                                <option value=""disabled selected>Select Key Status</option>
                                @foreach($keyStatuses as $keyStatus)
                                    <option value="{{ $keyStatus['id'] }}">{{ $keyStatus['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="keyway_id">Keyway</label>
                            <select class="form-control" id="keyway_id" name="keyway_id">
                                <option value=""disabled selected>Select Keyway</option>
                                @foreach($keyways as $keyway)
                                    <option value="{{ $keyway['id'] }}">{{ $keyway['name'] }}</option>
                                @endforeach
                            </select>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Datatable -->
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

@section('js')
    <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#key-table')) {
                $('#key-table').DataTable().destroy();
            }

            const table = $('#key-table').DataTable({
                "order": [],
                "columnDefs": [
                    { "orderable": false, "targets": {{ count($heads) - 1 }} }
                ]
            });

            // Handle form submission for adding a new key
            $('#newKeyForm').submit(function(e) {
                e.preventDefault();
                const formData = $(this).serialize();
                
                $.ajax({
                    url: '/keys',
                    method: 'POST',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response);
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
                $('#newKeyModal').modal('hide');
            });

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


