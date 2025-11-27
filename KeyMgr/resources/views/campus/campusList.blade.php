@extends ("adminlte::page")

@section('title', __('Campuses'))

@php
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
@include('campus.partials.campusModalForm', [
    'formID' => 'campusForm',
    'formTitle' => 'Campus Creation Form', 
    'submitURL' => route("campus.store"), 
  ])
@section('content_top_nav_left')
  <x-adminlte-button type='submit' theme="success" data-toggle="modal" data-target="#campusForm" label="New Campus" icon='fas fa-file'></x-adminlte-button>

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
      'submitMethod' => 'PUT',
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

      // Only importing edit form once, use JQuery to dynamically fill and update form.
      const TABLE = $('#table5').DataTable();
      $('#table5').on('click', '.btn-edit', function () {
        console.log("Oh my god a second event has struck the tower!");

        const DATA = TABLE.row($(this).closest('tr')).data();

        $('#form_editForm').attr('action', '/campus/' + DATA[0]);
        // Pre-fill the existing fields.
        $('#form_editForm #name').val(DATA[1]);
        $('#form_editForm #country').val(DATA[2]);
        $('#form_editForm #state').val(DATA[3]);
        $('#form_editForm #city').val(DATA[4]);
        $('#form_editForm #streetAddress').val(DATA[6]);
        $('#form_editForm #postalCode').val(DATA[5]);
      });


    });
  </script>
@stop