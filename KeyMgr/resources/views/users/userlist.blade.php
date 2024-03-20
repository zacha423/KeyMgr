@extends ("adminlte::page")
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
{{-- Minimal example / fill data using the component slot --}}
@section ("content")

<!-- Drop Down for UserRoles and UserGroups -->
<div class="flex-container">
  <div class="row">
    <h3>Limit results by:</h3>
  </div>
  <div class="row">

    {{-- UserGroup Selector --}}
    <div class="col">
      
      {{-- Example with multiple selections (for SelectBs) --}}
      @php
      $config2 = [
        "title" => "Select multiple options...",
        "liveSearch" => true,
        "liveSearchPlaceholder" => "Search...",
        "showTick" => true,
        "actionsBox" => true,
      ];
      @endphp
<x-adminlte-select-bs id="optionsUserGroup" name="optionsUserGroup[]" label="User Groups"
    label-class="text-info" :config="$config2" multiple>
    <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-lightblue">
            <i class="fas fa-tag"></i>
        </div>
    </x-slot>
    {{-- <x-adminlte-options :options="['News', 'Sports', 'Science', 'Games']"/> --}}
    <x-adminlte-options :options="$groupOptions"/>
</x-adminlte-select-bs>
  </div>


  <div class="col">
    {{-- Example with multiple selections (for SelectBs) --}}
@php
$config2 = [
  "title" => "Select multiple options...",
  "liveSearch" => true,
  "liveSearchPlaceholder" => "Search...",
  "showTick" => true,
  "actionsBox" => true,
];
@endphp
<x-adminlte-select-bs id="optionsCategory" name="optionsCategory[]" label="Categories"
    label-class="text-info" :config="$config2" multiple>
    <x-slot name="prependSlot">
        <div class="input-group-text bg-gradient-lightblue">
            <i class="fas fa-tag"></i>
        </div>
    </x-slot>
    <x-adminlte-options :options="$roleOptions"/>
</x-adminlte-select-bs>
</div>
</div>
</div>

@section('plugins.Datatables', true)

<!-- Button trigger modal -->
<div class="container">
  <div class="row">
    <div class="col-md-12 text-right">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Add User
      </button>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<x-adminlte-datatable id="table5" :heads="$heads" bordered compressed hoverable>
    @foreach($config['data'] as $row)
        <tr>
            @foreach($row as $cell)
                <td>{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
</x-adminlte-datatable>
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            var userId = $(this).data('user-id');
            if (confirm('Are you sure you want to delete this user?')) {
                $.ajax({
                    url: '/users/' + userId,
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

<script src="../../plugins/jquery/jquery.min.js"></script>






