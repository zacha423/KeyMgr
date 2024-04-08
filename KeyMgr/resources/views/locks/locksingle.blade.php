@extends('adminlte::page')

@section('title', 'Lock Details')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Lock Details</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('locks.index') }}">All Locks</a></li>
                <li class="breadcrumb-item active">Lock {{ $lock['id'] }}</li>
            </ol>
        </div>
    </div>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h2 class="card-title"><strong>Lock ID:</strong> {{ $lock['id'] }}</h2>
                        <div class="card-tools">
                            <a href="{{ route('locks.edit', ['lock' => $lock['id']]) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <button onclick="confirmDelete('{{ $lock['id'] }}')" class="btn btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </div>
                    </div>
                    <div class="card-body">

                        <p><strong>Number of Pins:</strong> @if(isset($lock['numPins'])){{ $lock['numPins'] }}@else Number of Pins not available @endif</p>
                        <p><strong>Building:</strong> @if(isset($lock['building'])){{ $lock['building'] }}@else Building not available @endif</p>
                        <p><strong>Room:</strong> @if(isset($lock['room'])){{ $lock['room'] }}@else Room not available @endif</p>
                        <p><strong>Install Date:</strong> @if(isset($lock['installDate'])){{ date('m/d/Y', strtotime($lockRes['installDate'])) }}@else Install Date not available @endif</p>


                        <p><strong>Upper Pins:</strong> @if(isset($lock['upperPinLengths'])){{ $lock['upperPinLengths'] }}@else Upper Pins not available @endif</p>
                        <p><strong>Lower Pins:</strong> @if(isset($lock['lowerPinLengths'])){{ $lock['lowerPinLengths'] }}@else Lower Pins not available @endif</p>
                        <p><strong>Keyway:</strong> @if(isset($lock['keyway'])){{ $lock['keyway'] }}@else Keyway not available @endif</p>
                    </div>
                </div>

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h2 class="card-title"><strong>Lock Model Information:</strong></h2>
                    </div>

                    <div class="card-body">
                        <p><strong>Model Name:</strong> @if(isset($lock['name'])){{ $lock['name'] }}@else Model Name not available @endif</p>
                        <p><strong>MACS:</strong> @if(isset($lock['MACS'])){{ $lock['MACS'] }}@else MACS not available @endif</p>
                        <p><strong>Manufacturer:</strong> @if(isset($lock['manufacturer'])){{ $lock['manufacturer'] }}@else Manufacturer not available @endif</p>
                    </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        function confirmDelete(lockID) {
            if (confirm("Are you sure you want to delete this lock?")) {
                window.location.href = "{{ route('locks.destroy', ['lock' => $lock['id']]) }}" + "/" + lockID;
            }
        }
    </script>
@stop
