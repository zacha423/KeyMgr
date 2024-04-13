@extends("adminlte::page")

@section('title', 'Roles | ' . $role['name'])

@section('content_header')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Role Details | {{ $role['name'] }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('roles.index') }}">Roles</a></li>
                        <li class="breadcrumb-item active">{{ $role['name'] }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@stop

@section("content")
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Role Information</h5>
                            <div class="btn-group">
                                <a href="{{ route('roles.edit', ['role' => $role['id']]) }}" data-toggle="modal" data-target="#updateRoleModal" id="updateRole" name="updateRole" class="btn btn-info mr-1"><i class="fas fa-edit"></i> Edit</a>
                                @include('users.partials.updateRoleModal', ['title' => 'Role Update Form'])
                                <form action="{{ route('roles.destroy', ['role' => $role['id']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h5 class="m-0">Users Assigned Role: <strong>{{ $role['name'] }}</strong></h5>
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">View all Users</a></li>
                </ol>
            </div>
            <div class="card-body">
                @include('users.partials.usersAssignedRoleTable')
            </div>
        </div>
    </div>
</div>
@stop
