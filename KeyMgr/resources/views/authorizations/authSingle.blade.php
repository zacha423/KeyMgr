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
      <x-adminlte-card theme="info" theme-mode="outline" title="Key Holder">
        <p><strong>Name: </strong>{{ $holder['name']}}</p>
        <p><strong>Email: </strong>{{ $holder['email'] }}</p>
        <div class="text-center">
          <div class="row">
            <div class="col">
              <x-adminlte-info-box title="Held Keys" text="{{ $holder['keys'] }}"/>
            </div>
            <div class="col">
              <x-adminlte-info-box title="Outstanding Keys" text="{{ $holder['withstanding'] }}"/>
            </div>
            <div class="col">
              <x-adminlte-info-box title="Agreements" text="{{ $holder['agreements'] }}"/>
            </div>
          </div>
        </div>
      </x-adminlte-card>
      <x-adminlte-card theme="info" theme-mode="outline" title="Key Requestor">
        <p><strong>Name: </strong>{{ $requestor['name'] }}</p>
        <p><strong>Email: </strong>{{ $requestor['email'] }}</p>
        <div class="text-center">
          <div class="row">
            <div class="col">
              <x-adminlte-info-box title="Held Keys" text="{{ $requestor['keys'] }}"/>
            </div>
            <div class="col">
              <x-adminlte-info-box title="test" text="{{ $requestor['withstanding'] }}"/>
            </div>
            <div class="col">
              <x-adminlte-info-box title="test" text="{{ $requestor['agreements'] }}"/>
            </div>
          </div>
        </div>
      </x-adminlte-card>
    </div>
    <div class="col-md-6">
      <x-adminlte-card theme="info" theme-mode="outline" title="Issued Key #1">
        <p><strong>Serial: </strong>{{ $key['serial'] }}</p>
        <div class="text-center">
          <div class="row">
            <div class="col">
              <x-adminlte-info-box title="Building" text="{{ $key['building'] }}"/>
            </div>
            <div class="col">
              <x-adminlte-info-box title="Room" text="{{$key['room']}}"/>
            </div>
          </div>
        </div>
      </x-adminlte-card>
      <x-adminlte-card theme="info" theme-mode="outline" title="Issued Key #2"><p>< To Be Implemented... ></p></x-adminlte-card>
    </div>
  </div>
</div>
{{-- Load Plugins --}}

@stop
