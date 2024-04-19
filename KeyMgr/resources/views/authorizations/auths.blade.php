@extends('adminlte::page')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('title', 'KeyMgr | Key Authorizations')

@section('content_header')
<div class='d-flex justify-content-between align-items-center'>
  <h1>List of Key Authorizations</h1>
</div>
@stop

@section('content')

{{-- Load Plugins --}}
@section('plugins.Datatables', true)
@section('plugins.BootStrapDatePicker', true)
@section('plugins.BootStrapSelect', true)
@section('plugins.DateRangePicker', true)
@section('plugins.TempusDominusBs4', true)

{{-- Search Limiter --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Limit results by: " collapsible>
  @include('authorizations.partials.authTableFilter')
</x-adminlte-card>
{{-- Key Authorization Tools --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Tools" collapsible>
  <x-adminlte-button theme="primary" type="button" label="Bulk Communication" disabled/>
  <x-adminlte-button theme="primary" type="button" label="Extend All" disabled/>
  <x-adminlte-button theme="danger" type="button" label="Terminate" disabled/>
  <x-adminlte-button theme="success" type="button" data-toggle="modal" data-target="#newAuthModal" label="Authorize Key(s)" class="float-right"/>
  @include('authorizations.modals.newAuthorization')
</x-adminlte-card>
{{-- Main Datatable --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Key Authorizations">
  @include('authorizations.partials.authtable')
</x-adminlte-card>

{{-- Page Scripts --}}
@push('js')
<script>  
  // Garbarino - replace this trash.
  $(() => {
    // $('div#auth-table_wrapper').click(($e) => {
    //   $('.btn-delete').click(function(e) {
    //     e.preventDefault();
    //     const authID = $(this).data('auth-id');
    //     if (confirm('Are you sure you want to delete this authorization?')) {
    //       $.ajax({
    //         url: '/authorizations/' + authID,
    //         method: 'POST',
    //         data: {
    //           _token: '{ { csrf_token() }}',
    //           _method: 'DELETE'
    //         },
    //         success: function(response) {
    //           location.reload();
    //         },
    //         error: function (xhr, status, error) {
    //           console.error(xhr.responseText);
    //         }
    //       });
    //     }
    //   });
    // });
    
    $('.btn-delete').click(function(e) {
      e.preventDefault();
      const authID = $(this).data('auth-id');
      if (confirm('Are you sure you want to delete this authorization?')) {
        $.ajax({
          url: '/authorizations/' + authID,
          method: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            _method: 'DELETE'
          },
          success: function(response) {
            location.reload();
          },
          error: function (xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }
    });
  });
</script>
@endpush
@stop