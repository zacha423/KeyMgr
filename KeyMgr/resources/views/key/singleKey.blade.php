@extends('adminlte::page')

@section('title', 'Key Details')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Key Details</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('keys.index') }}">All Keys</a></li>
                <li class="breadcrumb-item active">Key {{ $key['id'] }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h2 class="card-title"><strong>Key ID:</strong> {{ $key['id'] }}</h2>
                        <div class="card-tools">
                            <a href="{{ route('keys.edit', ['key' => $key['id']]) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button onclick="confirmDelete('{{ $key['id'] }}')" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <p><strong>Key Level: </strong> {{ $key['keyLevel'] }} </p>
                                <p><strong>Key System: </strong>{{ $key['keySystem'] }}</p>
                                <p><strong>Copy Number: </strong> {{ $key['copyNumber'] }}</p>
                                <p><strong>Bitting: </strong>{{ $key['bitting'] }} </p>
                                <p><strong>Replacement Cost: </strong>{{ $key['replacementCost'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-info card-outline">
                    <div class="card-body">
                        <h5 class="card-title">LOCKS</h5>
                        <!-- Add content related to locks here -->
                    </div>
                </div>

                <div class="card card-info card-outline">
                    <div class="card-body">
                        <h5 class="card-title">USER</h5>
                        <!-- Add content related to users here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        function confirmDelete(keyID) {
            if (confirm("Are you sure you want to delete this key?")) {
                window.location.href = "{{ route('keys.destroy', ['key' => $key['id']]) }}" + "/" + keyID;
            }
        }
    </script>
@stop
