@php
$heads = [
  'ID',
  'Name',
  'Member Users',
  'Member Groups',
  ['label' => 'Actions', 'no-export' => false, 'width' => 5],
];

$config = [
  'data' => $roles,
  'order' => [[1, 'asc']],
  'columns' => [null, null, null, null, ['orderable' => false]],
  'select' => true,
];
@endphp

<x-adminlte-datatable id="table5" :config="$config" :heads="$heads" bordered compressed hoverable>
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>
<script>
  function getSelectedIDs ($tableID) {
    let $IDs = [];
    if (!$.fn.DataTable.isDataTable('#' + $tableID))
    {
      return null;
    }

    new DataTable ('#' + $tableID).rows({selected:true}).data().toArray().forEach(($row) => {
      $IDs.push($row[0]);
    });

    return $IDs;
  }
</script>