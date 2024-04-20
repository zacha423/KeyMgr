@php
$heads = [
  'Key ID',
  'Serial',
  'Status',
  ['label' => 'Actions', 'no-export' => false, 'width' => 5],
];

$config = [
  'data' => $keys,
  'order' => [[1, 'asc']],
  'columns' => [
    null,
    null,
    null,
    ['orderable' => false],
  ],
];
@endphp
<x-adminlte-datatable id="keys-mini-table" :heads="$heads" :config="$config" bordered compressed hoverable>
  @foreach ($config['data'] as $row)
  <tr>
    @foreach($row as $cell)
    <td>{!! $cell !!}</td>
    @endforeach
  </tr>
  @endforeach
</x-adminlte-datatable>