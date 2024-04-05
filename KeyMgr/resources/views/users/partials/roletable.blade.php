@php
$heads = [
  'Name',
  '# of Users',
  ['label' => 'Actions', 'no-export' => false, 'width' => 5],
];

$config = [
  'data' => $roles,
  'order' => [[1, 'asc']],
  'columns' => [null, null, null, null, ['orderable' => false]],
];
@endphp

<x-adminlte-datatable id="table5" :heads="$heads" bordered compressed hoverable>
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>