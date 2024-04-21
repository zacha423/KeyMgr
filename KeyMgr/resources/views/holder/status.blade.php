@php
    $keysHeads = [
    'Key ID',
    'Key Status'
    ];
    $keysConfig = [
    'data' => $keysData,
    'order' => [[0, 'asc']],
    'columns' => [
        null,
        null,
    ],
    ];
@endphp

<x-adminlte-card title="Keys Table" theme="info" icon="fas fa-key" collapsible>
    <x-adminlte-datatable id="keysTable" :heads="$keysHeads" :config="$keysConfig" bordered compressed hoverable>
        @foreach ($keysConfig['data'] as $row)
            <tr>
                @foreach($row as $cell)
                    <td>{!! $cell !!}</td>
                @endforeach
            </tr>
        @endforeach
    </x-adminlte-datatable>
</x-adminlte-card>
