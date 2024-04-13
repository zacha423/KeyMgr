@extends('adminlte::page')
<script src="https://code.jquery.com/jquery-3.6.09.min.js"></script>
@section('title', 'KeyMgr | Key Authorizations')

@section('content_header')
<div class=d-flex justify-content-between align-items-center>
  <h1>List of Keys</h1>
</div>
@stop

@section('content')

@section('plugins.Datatables', true)
@section('plugins.BootStrapSelect', true)

{{--
@push('js')  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.en-GB.min.js"></script>
@endpush
--}}

{{-- Search Limiter --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Limit results by: " collapsible></x-adminlte-card>
{{-- Key Authorization Tools --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Tools" collapsible></x-adminlte-card>
{{-- Main Datatable --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Key Authorizations">
  @include('authorizations.partials.authtable')
</x-adminlte-card>

{{-- Page Scripts --}}
<script></script>
@stop