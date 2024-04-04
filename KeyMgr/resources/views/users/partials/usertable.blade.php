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
<x-adminlte-card theme="info" theme-mode="outline">
  <x-adminlte-datatable id="table5" :heads="$heads" :config="$config" bordered compressed hoverable>
      @foreach($config['data'] as $row)
          <tr>
              @foreach($row as $cell)
                  <td>{!! $cell !!}</td>
              @endforeach
          </tr>
      @endforeach
  </x-adminlte-datatable>
</x-adminlt-card>
<script>
  function getSelectedIDs ($tableID) {
    let $IDs = [];
    
    if (!$.fn.DataTable.isDataTable('#' + $tableID))
    {
      return null;
    }
    
    new DataTable ('#' + $tableID).rows({selected:true}).data().toArray().forEach(($row)=>{
      $IDs.push($row[0]);
    });

    return $IDs;
  }
</script>