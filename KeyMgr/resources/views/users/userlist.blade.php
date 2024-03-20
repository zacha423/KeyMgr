@extends ("adminlte::page")

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Minimal example / fill data using the component slot --}}
@section ("content")

<!-- Drop Down for UserRoles and UserGroups -->
<div class="flex-container">
  <div class="row">
    <h3>Limit results by:</h3>
  </div>
  <div class="row">

    {{-- UserGroup Selector --}}
    <div class="col" id="groupSelector">
      
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
      <x-adminlte-select-bs id="optionsUserGroup" name="optionsUserGroup[]" label="Groups"
                            label-class="text-info" :config="$config2" multiple>
        <x-slot name="prependSlot">
          <div class="input-group-text bg-gradient-lightblue">
            <i class="fas fa-tag"></i>
          </div>
        </x-slot>
        <x-adminlte-options :options="$groupOptions"/>
      </x-adminlte-select-bs>
    </div>

    {{-- UserRole Selector --}}
    <div class="col" id="roleSelector">

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
      <x-adminlte-select-bs id="optionsUserRole" name="optionsUserRole[]" label="Roles"
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

  {{-- Button to refresh page / limit search --}}
  <div class="row">
    <button type="button" class="btn btn-primary refineSearch" id="refineSearch">Refine Search</button>
    <script>
      $(document).ready(function () {
        $('.refineSearch').click(function(e) {
          $.ajax({
            url: '/users',
            method: 'GET',
            data: {
              _tokens: '{{ csrf_token() }}',
              _method: 'GET',
              role: $('#optionsUserRole').val(),
              group: $('#optionsUserGroup').val()
            },
            success: function(response) {
              $('#table').html (response.html); 
            },
            error: function(xhr, status, error) {
              console.error(xhr.responseText);
            }
          });
        });
      });
    </script>
  </div>
</div>

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
@section('plugins.Datatables', true)
  <div id="table">
    @include('users.partials.usertable')
  </div>
@stop

<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const userId = $(this).data('user-id');
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

{{-- <script src="../../plugins/jquery/jquery.min.js"></script> --}}






