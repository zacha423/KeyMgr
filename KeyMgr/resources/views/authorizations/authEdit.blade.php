@extends('adminlte::page')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('title', 'KeyMgr | Authorizations Details')

@section('content_header')
<div class="row mb-2">
  <div class="col-sm-6"><h1 class="m-0 text-dark">{{__('Edit Authorization') }}</h1></div>
  <div class="col-sm-6"><ol class="breadcrump float-sm-right"><li class="breadcrumb-item"><a href="{{ route('authorizations.index') }}">All Authorizations</a></li><li class="breadcrumb-item active">Authorization {{ $auth->id }}</li></div>
@stop

@section('content')
{{-- Load Plugins --}}

@stop
