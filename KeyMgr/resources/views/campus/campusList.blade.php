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

      // Only importing edit form once, use JQuery to dynamically fill and update form.
      $('.btn-edit').click(function(e) {
        const campusID = $(this).attr('dataVal'); // not likely needed given Datatables API
        console.log(this)
        console.log (campusID)
        console.log($('#table5').DataTable().row($(this).closest('tr')).data()); // returns array
        /*
        (8) ['2', 'College of Health Professions', 'United States of America', 'Oregon', 'Cornelius', '97113', '222 SE 8th Ave', '<div class="row">\n              <div>\n      \n    <…fw fa-eye"></i>\n    </a>\n</div>            </div>']
        0:"2"
        1:"College of Health Professions"
        2:"United States of America"
        3:"Oregon"
        4:"Cornelius"
        5:"97113"
        6:"222 SE 8th Ave"
        7:"<div class=\"row\">\n              <div>\n      \n    <button data-toggle=\"modal\" data-target=\"#editForm\" dataval=\"2\" class=\"btn btn-xs btn-default text-primary mx-1 shadow btn-edit\">\n      <i class=\"fa fa-lg fa-fw fa-pen\"></i>\n    </button>\n  </div>              <div>\n  <button class=\"btn btn-xs btn-default text-danger mx-1 shadow btn-delete\" title=\"Delete\" data-campus-id=\"2\">\n    <i class=\"fa fa-lg fa-fw fa-trash\"></i>\n  </button>\n</div>              <div>\n    <a href=\"http://localhost:8080/campus/2\" class=\"btn btn-xs btn-default text-teal mx-1 shadow\" title=\"Details\">\n      <i class=\"fa fa-lg fa-fw fa-eye\"></i>\n    </a>\n</div>            </div>"
        length:8
        */

        const CAMPUS = $('#table5').DataTable().row($(this).closest('tr')).data();
        
        // Update the action URL for the current campus.
        $('#editForm #newCampus').attr('action', '/campus/' + CAMPUS[0]); //need to update the @.method() call to include PUT/PATCH for update version.
        // Pre-fill the existing fields.
        $('#editForm #name').val(CAMPUS[1]);
        $('#editForm #country').val(CAMPUS[2]);
        $('#editForm #state').val(CAMPUS[3]);
        $('#editForm #city').val(CAMPUS[4]);
        $('#editForm #streetAddress').val(CAMPUS[5]);
        $('#editForm #postalCode').val(CAMPUS[6]);

        
        
      })
    });
  </script>
@stop