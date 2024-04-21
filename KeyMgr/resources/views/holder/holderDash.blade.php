@extends('adminlte::page')

@section('content_header')
    <h1>{{$users->getFullName()}} Dashboard</h1>
@stop

@section('plugins.Datatables', true)
@section('content')
	<div class="container-fluid">
		@include('holder.dueDate')

		@include('holder.status')

	</div>
@stop
