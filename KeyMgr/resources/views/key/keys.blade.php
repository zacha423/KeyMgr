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

<!-- Search Limiter -->
<x-adminlte-card theme="info" theme-mode="outline" title="Limit results by:" collapsible>
  <form>
    {{-- Building and Room Selector --}}
    <div class="row">
      <div class="col">
        <x-select-bs-wrapper id="id" name="na[]" label="immalabel" :options="[]" :selected="[]" fa-icon="" :config="[]"/>
      
        {{--<x-adminlte-select-bs id="id" name="name[]" label="Label" label-class="text-info" :config="[]" multiple enable-old-support>
          <x-slot name="prependSlot">
            <div class="input-group-text bg-gradient-lightblue">
              <i class="fas fa-tag"></i>
            </div>
          </x-slot>
          <x-adminlte-options :options="[]" :selected="[]"/>
        </x-adminlte-select-bs>--}}
      </div>
      <div class="col">

      </div>
    </div>
    {{-- Status and Keyway Selector --}}
    <div class="row">
      <div class="col">

      </div>
      <div class="col">

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
  <div class="row"><div class="col-1"></div><div class="col-1"></div><div class="col-1"></div></div>
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