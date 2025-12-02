@extends("adminlte::page")
@section('title', 'Campus | ' . ($campus['name']))

@php
$crumbs=[
  ['link' => '/locations', 'text' => 'Locations'],
  ['link' => route('campus.index'), 'text' => 'Campuses'],
  ['link' => '', 'text' => $campus['name']]
];
@endphp

@section('content_header')
<div class="row mb-2">
  <div class="col-sm">
    <h1 class="m-0 text-dark">Campus Details | {{$campus['name']}}</h1>
  </div>
  <div class="col-sm">
    <x-breadcrumb :crumbs="$crumbs"></x-breadcrumb>
  </div>
</div>
@stop
@section('plugins.Datatables', true)
@section('content_top_nav_left')
  <x-adminlte-button id="edit" type="submit" theme="info" icon="fas fa-edit" label="Edit"></x-adminlte-button>
  <x-adminlte-button id="delete" type="submit" theme="danger" icon="fas fa-trash-alt" label="Delete" form="deleteCampus"></x-adminlte-button>
  <x-adminlte-button id="save" type="submit" theme="success" label="Save" form="editData"></x-adminlte-button>
  <x-adminlte-button id="cancel" type="submit" theme="danger" label="Cancel"></x-adminlte-button>
  <form id="deleteCampus" class="display:none" name="deleteCampus" method="POST" action="{{ route('campus.destroy', ['campus' => $campus['id']]) }}" onsubmit="return confirm('Are you sure about that?');">
    @csrf
    @method('DELETE')
  </form>
@endsection

@section("content")



<div class="row">
  <div class="col-lg-6">
    <x-adminlte-card theme="info" theme-mode="outline" title="Campus Information">
      <form id="editData" name="editData" method="post" action="{{ route('campus.update', ['campus' => $campus['id']]) }}"> <!-- names need updated to maatch expeected form values -->
        @method('PUT')
        @csrf
        <x-adminlte-input disabled enable-old-support name="country" label="Country" value="{{ $campus['country'] ?? '' }}"></x-adminlte-input>
        <x-adminlte-input disabled enable-old-support name="state" label="State" value="{{ $campus['state'] ?? '' }}"></x-adminlte-input>
        <x-adminlte-input disabled enable-old-support name="city" label="City" value="{{ $campus['city'] ?? '' }}"></x-adminlte-input>
        <x-adminlte-input disabled enable-old-support name="postal" label="Zip Code" value="{{ $campus['postalCode'] ?? '' }}"></x-adminlte-input>
        <x-adminlte-input disabled enable-old-support name="streetAddress" label="Street Address" value="{{ $campus['streetAddress'] ?? '' }}"></x-adminlte-input>
      </form>
    </x-adminlte-card>
  </div>  
  <div class="col-lg-6">
    <x-adminlte-card theme="info" theme-mode="outline" title="Buildings On Campus">
      <x-slot name="toolsSlot">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ route('building.index') }}">View all Buildings</a></li>
        </ol>
      </x-slot>
      @include('campus.partials.campusBuildingsDatatable')
    </x-adminlte-card>
  </div>
  
</div>
@stop

@section('js')
<script>
  $(document).ready(function () {
    $('form[name="editData"] input.form-control').each(function (index, element) {
      $(element).attr('initValue', $(element).val());
    });
    $('#save').toggle();
    $('#cancel').toggle();

    // Enter edit mode
    $('#edit').click(() => {
      $('nav button').toggle();
      $('form[name="editData"] input').prop('disabled', false);
    });

    // Exit Edit Mode
    $('#cancel').click(() => {
      $('nav button').toggle();
      $('form[name="editData"] input').prop('disabled', true);

      $('form[name="editData"] input.form-control').each((index, element) => {
        $(element).val($(element).attr('initValue'));
      });
    })
  });
</script>
@stop