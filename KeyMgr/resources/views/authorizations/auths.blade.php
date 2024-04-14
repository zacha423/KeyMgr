@extends('adminlte::page')
@section('title', 'KeyMgr | Key Authorizations')

@section('content_header')
<div class=d-flex justify-content-between align-items-center>
  <h1>List of Key Authorizations</h1>
</div>
@stop

@section('content')

{{-- Load Plugins --}}
@section('plugins.Datatables', true)
@section('plugins.BootStrapDatePicker', true)
@section('plugins.BootStrapSelect', true)

{{-- Search Limiter --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Limit results by: " collapsible>
  @include('authorizations.partials.authTableFilter')
</x-adminlte-card>
{{-- Key Authorization Tools --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Tools" collapsible></x-adminlte-card>
{{-- Main Datatable --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Key Authorizations">
  @include('authorizations.partials.authtable')
</x-adminlte-card>

{{-- Page Scripts --}}
<script></script>
@stop