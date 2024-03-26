@php
$heads = [
  'ID',
  'Group Name',
  'Parent Group',
  ['label' => 'Actions', 'no-export' => false, 'width' => 5],
];

$config = [
  'data' => $groups,
  'order' => [[1, 'asc']],
  'columns' => [null, null, null, ['orderable' => false]],
];
@endphp

<x-adminlte-datatable id="table1" :heads="$heads" bordered compressed hoverable>
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>
