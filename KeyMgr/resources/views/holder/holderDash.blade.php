@extends('adminlte::page')

@section('content_header')
    <h1>{{$users->getFullName()}} Dashboard</h1>
@stop

@section('plugins.Datatables', true)

@php
    use Illuminate\Support\Carbon;

    $heads = [
        'Key ID',
        'Return Date',
        'Key Status',
				'Return Status',
    ];


    $config = [
        'data' => $keysData,
        'order' => [[1, 'asc']],
        'columns' => [
            null, 
            null,
            ['orderable' => false],
						null,
        ],
    ];
@endphp

@section('content')

<div class="row">
    <div class="col-lg-3 col-6">

        <div class="small-box bg-info">

            <div class="inner">
                <h3>{{$counts['keys']}}</h3>
                <p>Total Keys</p>
            </div>
            <div class="icon">
                <i class="fas fa-fw fa-key"></i>
            </div>
            <a href="/keys" class="small-box-footer">More info <i class="fas fa-arrow-circle-right" disabled></i></a>
        </div>

    </div>

		<div class="col-lg-3 col-6">

		<div class="small-box bg-warning">

				<div class="inner">
						<h3>{{$counts['upcoming']}}</h3>
						<p>Keys Due in 7 Days</p>
				</div>
				<div class="icon">
						<i class="fas fa-fw fa-key"></i>
				</div>
				<a href="/keys" class="small-box-footer">More info <i class="fas fa-arrow-circle-right" disabled></i></a>
		</div>

		</div>

		<div class="col-lg-3 col-6">

		<div class="small-box bg-success">

				<div class="inner">
						<h3>{{$counts['dueSoon']}}</h3>
						<p>Keys Due in 30 Days</p>
				</div>
				<div class="icon">
						<i class="fas fa-fw fa-key"></i>
				</div>
				<a href="/keys" class="small-box-footer">More info <i class="fas fa-arrow-circle-right" disabled></i></a>
		</div>

		</div>

		<div class="col-lg-3 col-6">

<div class="small-box bg-danger">

		<div class="inner">
				<h3>{{$counts['overdue']}}</h3>
				<p>Overdue Keys</p>
		</div>
		<div class="icon">
				<i class="fas fa-fw fa-key"></i>
		</div>
		<a href="/keys" class="small-box-footer">More info <i class="fas fa-arrow-circle-right" disabled></i></a>
</div>

</div>

	<x-adminlte-card title="Users Keys" theme="info" icon="fas fa-key" collapsible>
		<x-adminlte-datatable id="upcomingDueDatesTable" :heads="$heads" :config="$config" bordered compressed hoverable>
				@foreach ($config['data'] as $row)
						<tr>
								@foreach($row as $cell)
										<td>{!! $cell !!}</td>
								@endforeach
						</tr>
				@endforeach
		</x-adminlte-datatable>
	</x-adminlte-card>
@stop