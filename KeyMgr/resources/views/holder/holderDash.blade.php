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
        $daysUntilDue = Carbon::now()->diffInDays($dueDate, false);
        
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