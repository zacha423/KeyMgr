@php
    $dueDatesHeads = [
    'Key ID',
    'Due Date',
    ];
    $dueDatesConfig = [
    'data' => $keyDates,
    'order' => [[0, 'asc']],
    'columns' => [
        null, 
        null, 
    ],
    ];
@endphp

<x-adminlte-card title="Upcoming Due Dates" theme="warning" icon="fas fa-calendar-alt" collapsible>
    <x-adminlte-datatable id="upcomingDueDatesTable" :heads="$dueDatesHeads" :config="$dueDatesConfig" bordered compressed hoverable>
        @foreach ($dueDatesConfig['data'] as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
</x-adminlte-card>
