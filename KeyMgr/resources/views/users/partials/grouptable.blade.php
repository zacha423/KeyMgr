@php
$heads = [
  'ID',
  'Group Name',
  'Parent Group',
  'Member Users',
  'Assigned Roles',
  ['label' => 'Actions', 'no-export' => false, 'width' => 5],
];

$config = [
  'data' => $groups,
  'order' => [[1, 'asc']],
  'columns' => [null, null, null, null, null, ['orderable' => false]],
  'select' => true,
];
@endphp

<x-adminlte-datatable id="groupTable" name="test" :heads="$heads" :config="$config" bordered compressed hoverable>
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
