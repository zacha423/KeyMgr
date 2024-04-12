@extends("adminlte::page")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@section('title', 'KeyMgr | Keys')

@section('content_header')
  <div class="d-flex justify-content-between align-items-center">
    <h1>List of Keys</h1>
  </div>
@stop

@section("content")
@section('plugins.Datatables', true)
@section('plugins.BootStrapSelect', true)

<!-- Search Limiter -->
<x-adminlte-card theme="info" theme-mode="outline" title="Limit results by:" collapsible>
  <form>
    {{-- Building and Room Selector --}}
    <div class="row">
      <div class="col">
        <x-select-bs-wrapper id="buildingSelect" name="buildings[]" label="Building" :options="$buildings" :selected="[]" faicon="fas fa-building" :config="[]"/>
      </div>
      <div class="col">
        <x-select-bs-wrapper id="roomSelect" name="rooms[]" label="Room" :options="['title' => 'test']" :selected="[]" faicon="fas fa-door-closed" :config="[]"/>
      </div>
    </div>
    {{-- Status and Keyway Selector --}}
    <div class="row">
      <div class="col">
        <x-select-bs-wrapper id="statusSelect" name="statuses[]" label="Status" :options="$keyStatuses" :selected="[]" faicon="fas fa-traffic-light" :config="[]"/>
      </div>
      <div class="col">
        <x-select-bs-wrapper id="keywaySelect" name="keyways[]" label="Keyway" :options="$keyways" :selected="[]" faicon="fas fa-key" :config="[]"/>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <x-adminlte-button theme="primary" type="submit" label="Refine Search"/>
      </div>
    </div>
  </form>
</x-adminlte-card>

<!-- Key Tools -->
<x-adminlte-card theme="info" theme-mode="outline" title="Tools" collapsible>
  <div class="row">
    <div class="col-1 p-0">
      <x-adminlte-button theme="primary" type="button" label="Manage Users" data-toggle="modal" data-target="#usersForm"/>
    </div>
    <div class="col-1 p-0">
      <x-adminlte-button theme="primary" type="button" label="Manage Locks" data-toggle="modal" disabled/>
    </div>
    <div class="col-9 p-0"></div>
    <div class="col-1 p-0">
      @include ('key.modals.newKey')  
      <x-adminlte-button class="float-right" theme="success" type="button" label="New Key" data-toggle="modal" data-target="#newKeyModal"/>
    </div>
  </div>
</x-adminlte-card>

<!-- Main Datatable -->
<x-adminlte-card theme="info" theme-mode="outline" >
  @include('key.partials.keysTable')
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