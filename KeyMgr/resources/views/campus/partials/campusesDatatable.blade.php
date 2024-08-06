@php
  $heads = [
    'ID',
    'Name',
    'Country',
    'State',
    'City',
    'Zip',
    'Street Address',
    ['label' => 'Actions', 'no-export' => false, 'width' => 10],
  ];

  $config = [
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
  ];
@endphp

<div class="card">
  <div class="card-body">
    <x-adminlte-datatable id="table5" :heads="$heads" :config="$config" bordered compressed hoverable>
      @foreach($campuses as $row)
        <tr>
          @foreach($row as $cell)
            <td>{!! $cell !!}</td>
          @endforeach
          <td>
            <div class="row">
              <x-edit-button formID="#editForm"></x-edit-button>
              <x-delete-button data-attribute="data-campus-id" campus-ID="{{$row[0]}}"></x-delete-button>
              <x-details-button route="{{route('campus.show', $row[0])}}"></x-details-button>
            </div>
          </td>
        </tr>
      @endforeach
    </x-adminlte-datatable>
  </div>
</div>