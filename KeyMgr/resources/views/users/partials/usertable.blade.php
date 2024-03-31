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
<script>    
  // Basic structure is to the get all elements in selected table rows, of a particular column. Then parse that for forms/requests.
  function getThings () {
    return $('tr.selected > td.indx_0');
  }
</script>
<x-adminlte-datatable id="table5" :heads="$heads" bordered compressed hoverable>
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $key =>$cell)
                {{-- Added class to uniquely identify a given <td> each <tr>. --}}
                <td class="indx_{{$key}}">{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>
