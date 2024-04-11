@extends("adminlte::page")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



@section('title', 'KeyMgr | Keys')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>List of Keys</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#newKeyModal">New Key</button>
    </div>
@stop

@section("content")
@section('plugins.Datatables', true)
@include ('key.modals.newKey')

{{-- Setup data for datatables --}}
@php
$heads = [
  'ID',
  'Key Level',
  'Key System',
  'Copy Number',
  'Bitting',
  'Replacement Cost',
  'Key Status',
  'Keyway',
  ['label' => 'Actions', 'no-export' => false, 'width' => 5],
];

$config = [
  'data' => $keys,
  'order' => [[1, 'asc']],
  'columns' => [
    null,
    null,
    null, 
    null,
    null,
    null,
    null,
    null,
    ['orderable' => false],
  ],
  'select' => true,
];
@endphp

<!-- Search Limiter -->
<x-adminlte-card theme="info" theme-mode="outline" title="Limit results by:" collapsible>
  
</x-adminlte-card>

<!-- Key Tools -->
<x-adminlte-card theme="info" theme-mode="outline" title="Tools" collapsible>

</x-adminlte-card>

<!-- Main Datatable -->
<x-adminlte-card theme="info" theme-mode="outline" >
  <x-adminlte-datatable id="key-table" :heads="$heads" :config="$config" bordered compressed hoverable>
    @foreach($config['data'] as $row)
      <tr>
        @foreach($row as $cell)
          <td>{!! $cell !!}</td>
        @endforeach
      </tr>
    @endforeach
  </x-adminlte-datatable>
</x-adminlte-card>

<script>
  $(document).ready(function() {
    // Handle key deletion
    $('.btn-delete').click(function(e) {
      e.preventDefault();
      const keyId = $(this).data('key-id');
      if (confirm('Are you sure you want to delete this key?')) {
        $.ajax({
          url: '/keys/' + keyId,
          method: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            _method: 'DELETE'
          },
          success: function(response) {
            location.reload();
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }
    });    
  });
</script>
@stop