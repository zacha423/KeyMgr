@php
$heads = [
    'ID',
    'Name',
    ['label' => 'Actions', 'no-export' => false, 'width' => 5],
];

$config = [
    'data' => $buildings,
    'order' => [[1, 'asc']],
    'columns' => [null, null, ['orderable' => false]],
];
@endphp

<x-adminlte-datatable id="table5" :heads="$heads" :config="$config" bordered compressed hoverable>
  @foreach($config['data'] as $row)
    <tr>
      @foreach($row as $cell)
        <td>{!! $cell !!}</td>
      @endforeach
    </tr>
  @endforeach
</x-adminlte-datatable>
