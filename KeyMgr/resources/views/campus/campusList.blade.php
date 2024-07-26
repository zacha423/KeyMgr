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

@section ("content")
  @section('plugins.Datatables', true)
  <x-adminlte-card> {{-- Temporary placeholder card just for visual benefit--}}
    <div class="col text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#campusForm">New Campus</button>
    </div>  
  </x-adminlte-card>

  @include('campus.partials.createCampusModal')

  <x-adminlte-card theme="info" theme-mode="outline">
  <div class="flex-container">
    @include('campus.partials.campusesDatatable')
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
      });
  </script>
@stop