@extends("adminlte::page")
@section('title', 'Edit User | ' . ($user['firstName']))

<head>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Edit User Details | {{$user['firstName']}}</h1>
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

@section ("content")
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('users.partials.update-user-information')

                </div>
            </div>
        </div>
    </div>

@stop
