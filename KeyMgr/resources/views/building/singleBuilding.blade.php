@extends('adminlte::page')

@section('title', __('Building Details'))

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Building Details</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('building.index') }}">Buildings</a></li>
                        <li class="breadcrumb-item active">{{ $building['name'] }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@stop

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="m-0">Number of Rooms</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $numberOfRooms }}</p>
                            <a href="{{ route('building.buildingRooms',['building' => $building['id']]) }}" class="btn btn-primary">View All Rooms</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Building Address</h5>
                            <div class="btn-group">
                                <a href="{{ route('building.edit', ['building' => $building['id']]) }}" class="btn btn-info mr-1"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('building.destroy', ['building' => $building['id']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>


                        <div class="card-body">
                            <p><strong>Street Address:</strong> @if(isset($building['streetAddress'])){{ $building['streetAddress'] }}@else Street Address information not available @endif</p>
                            <p><strong>Country:</strong> @if(isset($building['country'])){{ $building['country'] }}@else Country information not available @endif</p>
                            <p><strong>State:</strong> @if(isset($building['state'])){{ $building['state'] }}@else State information not available @endif</p>
                            <p><strong>City:</strong> @if(isset($building['city'])){{ $building['city'] }}@else City information not available @endif</p>
                            <p><strong>Postal Code:</strong> @if(isset($building['postalCode'])){{ $building['postalCode'] }}@else Postal Code information not available @endif</p>
                            <p><strong>Campus Location:</strong> @if(isset($building['campus'])){{ $building['campus'] }}@else Campus information not available @endif</p>
                        </div>
               
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
