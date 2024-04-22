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

    $processedKeyDates = [];
    foreach ($keysData as $row) {
        $dueDate = Carbon::parse($row[1]);
        //$daysUntilDue = (Carbon::now()->diffInDays($dueDate, false));
        $daysUntilDue = abs($dueDate->diffInDays(Carbon::now(), false));
        var_dump($daysUntilDue);
        if ($daysUntilDue < 0) {
            $status = 'Overdue';
            $colorClass = 'text-danger';
        } elseif ($daysUntilDue == 0) {
            $status = 'Due Today';
            $colorClass = 'text-warning';
        } elseif ($daysUntilDue <= 7) {
            $status = 'Due Soon';
            $colorClass = 'text-warning';
        } else {
            $status = 'Upcoming';
            $colorClass = 'text-success';
        }

        $row[] = '<span class="' . $colorClass . '">' . $status . '</span>';
        
        $processedKeyDates[] = $row;
    }

    $config = [
        'data' => $processedKeyDates,
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
                <p>Keys</p>
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
						<p>Keys</p>
				</div>
				<div class="icon">
						<i class="fas fa-fw fa-key"></i>
				</div>
				<a href="/keys" class="small-box-footer">More info <i class="fas fa-arrow-circle-right" disabled></i></a>
		</div>

		</div>

		<div class="col-lg-3 col-6">

		<div class="small-box bg-info">

				<div class="inner">
						<h3>{{$counts['dueSoon']}}</h3>
						<p>Keys</p>
				</div>
				<div class="icon">
						<i class="fas fa-fw fa-key"></i>
				</div>
				<a href="/keys" class="small-box-footer">More info <i class="fas fa-arrow-circle-right" disabled></i></a>
		</div>

		</div>

		<div class="col-lg-3 col-6">

<div class="small-box bg-info">

		<div class="inner">
				<h3>{{$counts['overdue']}}</h3>
				<p>Keys</p>
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