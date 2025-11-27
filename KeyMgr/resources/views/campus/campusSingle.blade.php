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
  <x-adminlte-button type="submit" theme="info" icon="fas fa-edit" label="Edit"></x-adminlte-button>
  <x-adminlte-button type="submit" theme="danger" icon="fas fa-trash-alt" label="Delete" form="deleteCampus"></x-adminlte-button>
  <x-adminlte-button type="submit" theme="success" label="Save"></x-adminlte-button>
  <x-adminlte-button type="submit" theme="danger" label="Cancel"></x-adminlte-button>
  <form id="deleteCampus" class="display:none" name="deleteCampus" method="POST" action="{{ route('campus.destroy', ['campus' => $campus['id']]) }}" onsubmit="return confirm('Are you sure about that?');">
    @csrf
    @method('DELETE')
  </form>
@endsection

@section("content")



<div class="row">
  <div class="col-lg-6">
    <x-adminlte-card theme="info" theme-mode="outline" title="Campus Information">
      <x-slot name="toolsSlot">
        <div class="btn-group">
          <a href="{{ route('campus.edit', ['campus' => $campus['id']]) }}" class="btn btn-info mr-1"><i class="fas fa-edit"></i> Edit</a>
        </div>
      </x-slot>
      <p><strong>Country:</strong> @if(($campus['country'])){{$campus['country']}}@else Country information not available @endif</p>
      <p><strong>State:</strong> @if(($campus['state'])){{$campus['state']}}@else State information not available @endif</p>
      <p><strong>City:</strong> @if(($campus['city'])){{$campus['city']}}@else City information not available @endif</p>
      <p><strong>Postal Code:</strong> @if(($campus['postalCode'])){{$campus['postalCode']}}@else Postal Code information not available @endif</p>
      <p><strong>Street Address:</strong> @if(($campus['streetAddress'])){{$campus['streetAddress']}}@else Street Address information not available @endif</p>
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
    $('button.btn-info').click(function () {
      console.log('wazzip');
    });
  });
</script>
@stop