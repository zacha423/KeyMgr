{{-- Setup data for datatables --}}
@php
$heads = [
  'ID',
  'First Name',
  'Last Name',
  'Email',
  'Username',
  'Group',
  'Role',
  ['label' => 'Actions', 'no-export' => false, 'width' => 5],
];

$config = [
  'data' => $users,
  'order' => [[1, 'asc']],
  'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
  'select' => true,
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
