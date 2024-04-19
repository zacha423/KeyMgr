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
@section('plugins.Datatables', true)
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h2 class="card-title text-primary">Key ID: {{ $key['id'] }}</h2>
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
                <x-adminlte-card title="Locks" theme="primary" theme-mode="outline">
                    @include ('key.partials.locksMiniTable')
                </x-adminlte-card>
                @if(isset($holder))
                <x-adminlte-card id="keyHolderCard" title="Key Holder" theme="primary" theme-mode="outline">
                    <p><strong>Key Holder ID: </strong>{{  $holder['holderID'] }}</p>
                    <p><strong>Full name: </strong>{{ $holder['holder'] }}</p>
                    <p><strong>Key Authorization: </strong>#{{ $holder['auth'] }}</p>
                    <p><strong>Return Date: </strong>{{ $holder['dueDate'] }}</p>
                </x-adminlte-card>
                @endif
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        function confirmDelete(keyID) {
            if (confirm("Are you sure you want to delete this key?")) {
                window.location.href = "{{ route('keys.destroy', ['key' => $key['id']]) }}";
            }
        }
    </script>
@stop
