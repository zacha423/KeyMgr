@extends ("adminlte::page")

@section('title', __('Campuses'))

@php
// Details for breadcrumb navigation
$crumbs=[
  ['link' => '/locations', 'text' => 'Locations'],
  ['link' => '/campus', 'text' => 'Campuses'],
];
@endphp

@section('content_header')
  <div class="row mb-2">
    <div class="col-sm">
      <h1>List of Campuses</h1> {{-- Translation? --}}
    </div>
    <div class="col-sm">
      <x-breadcrumb :crumbs="$crumbs"></x-breadcrumb>
    </div>
  </div>
@stop
@section('plugins.Datatables', true)

@section('content_top_nav_left')
  <x-adminlte-button type='submit' theme="success" data-toggle="modal" data-target="#campusForm" label="New Campus" icon='fas fa-file'></x-adminlte-button>
  @include('campus.partials.campusModalForm', [
    'formID' => 'campusForm',
    'formTitle' => 'Campus Creation Form', 
    'submitURL' => '{{ route("campus.store") }}', 
    'submitMethod' => 'POST'
  ])
@stop

@section ("content")  
  {{-- Filter Tool Card --}}
  <x-adminlte-card theme="info" theme-mode="outline" title="Limit Results By">

  </x-adminlte-card>

  {{-- Datatable Card --}}
  <x-adminlte-card theme="info" theme-mode="outline">
  <div class="flex-container">
    @include('campus.partials.campusesDatatable')
    @include ('campus.partials.campusModalForm', [
      'formID' => 'editForm',
      'formTitle' => 'Campus Update Form',
      'submitURL' => '', // This has be to set using JS
      'submitMethod' => 'POST',
    ])
  </div>
  </x-adminlte-card>
@stop

@section('js')
  <script>
    $(document).ready(function() {
      $('.btn-delete').click(function(e) {
        e.preventDefault();
        const campusId = $(this).data('campus-id');
        if (confirm('Are you sure you want to delete this campus?')) { 
          $.ajax({
            url: '/campus/' + campusId,
            method: 'POST',
            data: {
              _token: '{{ csrf_token() }}',
              _method: 'DELETE'
            },
            success: function(response) {
              location.reload();
            },
            error: function(xhr, status, error) {
              console.error(xhr.responseText);
            }
          });
        }
      });
      $('.btn-edit').click(function(e) {
        const campusID = $(this).attr('dataVal');
        var zachsample = this;
        console.log(zachsample)
        console.log (campusID)
        // need to select data from table and fill into form...
        // Datatables API
      })
    });
  </script>
@stop