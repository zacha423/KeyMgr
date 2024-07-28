@extends("adminlte::page")
@section('title', 'Campus | ' . ($campus['name']))

@section('content_header')
<div class="row mb-2">
  <div class="col-sm-6">
    <h1 class="m-0 text-dark">Campus Details | {{$campus['name']}}</h1>
  </div>
  <div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route('campus.index') }}">Campuses</a></li>
      <li class="breadcrumb-item active">{{ $campus['name'] }}</li>
    </ol>
  </div>
</div>
@stop

@section("content")
@section('plugins.DataTables', true)
<div class="row">
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
  <div class="col-lg-6">
    <x-adminlte-card theme="info" theme-mode="outline" title="Campus Information">
      <x-slot name="toolsSlot">
      <div class="btn-group">
            <a href="{{ route('campus.edit', ['campus' => $campus['id']]) }}" class="btn btn-info mr-1"><i class="fas fa-edit"></i> Edit</a>
            <form action="{{ route('campus.destroy', ['campus' => $campus['id']]) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i> Delete</button>
            </form>
          </div>
      </x-slot>
      <p><strong>Country:</strong> @if(($campus['country'])){{$campus['country']}}@else Country information not available @endif</p>
      <p><strong>State:</strong> @if(($campus['state'])){{$campus['state']}}@else State information not available @endif</p>
      <p><strong>City:</strong> @if(($campus['city'])){{$campus['city']}}@else City information not available @endif</p>
      <p><strong>Postal Code:</strong> @if(($campus['postalCode'])){{$campus['postalCode']}}@else Postal Code information not available @endif</p>
      <p><strong>Street Address:</strong> @if(($campus['streetAddress'])){{$campus['streetAddress']}}@else Street Address information not available @endif</p>
    </x-adminlte-card>
  </div>
</div>
@stop