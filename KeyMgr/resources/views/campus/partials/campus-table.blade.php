@php
$heads = [
    'ID',
    'Name',
    'Country',
    'State',
    'City',
    'Zip',
    'Street Address',
    ['label' => 'Actions', 'no-export' => false, 'width' => 5],
];

$config = [
    'data' => $campuses,
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]],
];
@endphp
    <div class="card">
        <div class="card-body">
            <x-adminlte-datatable id="table5" :heads="$heads" bordered compressed hoverable>
                @foreach($config['data'] as $row)
                    <tr>
                        @foreach($row as $cell)
                            <td>{!! $cell !!}</td>
                        @endforeach
                    </tr>
                @endforeach
            </x-adminlte-datatable>
    </div>
</div>