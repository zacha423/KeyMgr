@extends('adminlte::page')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('title', 'KeyMgr | Authorizations Details')

@section('content_header')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1 class="m-0 text-dark">{{__('Authorization Details') }}</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item">
        <a href="{{ route('authorizations.index') }}">All Authorizations</a>
      </li>
      <li class="breadcrumb-item active">Authorization {{ $auth->id }}</li>
    </oL>
  </div>
@stop

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <x-adminlte-card theme="info" theme-mode="outline" title="Key Holder"><p><strong>Name: </strong>alyssa mendosa</p><p><strong>Email: </strong>am@pacu.edu</p><div class="text-center"><div class="row"><div class="col"><x-adminlte-info-box title="Held Keys" text="{{ $holder['keys'] }}"/></div><div class="col"><x-adminlte-info-box title="Outstanding Keys" text="test"/></div><div class="col"><x-adminlte-info-box title="Agreements" text="test"/></div></div></div></x-adminlte-card>
      <x-adminlte-card theme="info" theme-mode="outline" title="Key Requestor"><p><strong>Name: </strong>alyssa mendosa</p><p><strong>Email: </strong>am@pacu.edu</p><div class="text-center"><div class="row"><div class="col"><x-adminlte-info-box title="Held Keys" text="{{ $requestor['keys'] }}"/></div><div class="col"><x-adminlte-info-box title="test" text="test"/></div><div class="col"><x-adminlte-info-box title="test" text="test"/></div></div></div></x-adminlte-card>
    </div>
    <div class="col-md-6">
      <x-adminlte-card theme="info" theme-mode="outline" title="Issued Key #1">a</x-adminlte-card>
      <x-adminlte-card theme="info" theme-mode="outline" title="Issued Key #2"><p></p></x-adminlte-card>
    </div>
  </div>
</div>
{{-- Load Plugins --}}

@stop
