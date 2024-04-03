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
                        <h1> INSERT LOCK INFORMATION </h1>
                        <ul>
                            <li> Number of Pins </li>
                            <li> Upper Pins </li>
                            <li> Lower Pins </li>
                            <li> Building </li>
                            <li> Room </li>
                            <li> Keyway </li>
                            <li> Install Date </li>
                            <li> Model Information (New Card) </li>
                        </ul>
                            
                        <!-- <p><strong>Description:</strong> @if(isset($lock['description'])){{ $lock['description'] }}@else Description not available @endif</p>
                        <p><strong>Building:</strong> @if(isset($lock['building_id'])){{ $lock['building']->name }}@else Building not available @endif</p>
                        <p><strong>Door Description:</strong> @if(isset($lock['id'])){{ optional($door)->description ?: 'Not available' }}@else Door information not available @endif</p>
                        <p><strong>Door Hardware:</strong> @if(isset($lock['id'])){{ optional($door)->hardwareDescription ?: 'Not available' }}@else Door information not available @endif</p> -->
                    </div>
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
