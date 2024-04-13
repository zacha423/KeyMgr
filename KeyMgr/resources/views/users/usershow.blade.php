@extends("adminlte::page")
@section('title', 'Users | ' . ($user['firstName']))

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">User Details | {{$user['firstName']}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Users List</a></li>
                    <li class="breadcrumb-item active">{{ $user['firstName'] }}</li>
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
                            <h5 class="m-0">User Information</h5>
                            <div class="btn-group">
                                <a href="{{ route('users.edit', ['user' => $user['id']]) }}"
                                    class="btn btn-info mr-1"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('users.destroy', ['user' => $user['id']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i>
                                        Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p><strong>First Name:</strong> @if(($user['firstName'])){{$user['firstName']}}@else
                            Information not available @endif</p>
                        <p><strong>Last Name:</strong> @if(($user['lastName'])){{$user['lastName']}}@else
                            Information not available @endif</p>
                        <p><strong>Email:</strong> @if(($user['email'])){{$user['email']}}@else Information not
                            available @endif</p>

                        <div class="row">
                            <div class="col-md-4">
                                <x-adminlte-select label="Group Memberships" id="usergroups" name="usergroups[]"
                                    disabled multiple>
                                    <x-adminlte-options :options="$memberGroups"></x-adminlte-options>
                                </x-adminlte-select>
                            </div>
                            <div class="col-md-4">
                                <x-adminlte-select label="Role Memberships" id="userroles" name="userroles[]"
                                    disabled multiple>
                                    <x-adminlte-options :options="$memberRoles"></x-adminlte-options>
                                </x-adminlte-select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
