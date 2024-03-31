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
  'columns' => [null, null, null, ['orderable' => false]],
];
@endphp

<x-adminlte-datatable id="table5" :heads="$heads" bordered compressed hoverable>
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as /*$key =>*/$cell)
                {{--<!-- <td class="indx_{{$key}}">{!! $cell !!}</td> -->--}}
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>
