@extends ("adminlte::page")
@section('title', __('User Groups'))

@section('content_header')
    <h1>User Groups</h1>
@stop

@section('content')

@section('plugins.Datatables', true)

<x-adminlte-card theme="info" theme-mode="outline" title="Add New Group" collapsible>
  <form action="/groups" method="POST">
    @csrf
    <div class="row">
      {{-- Parent Group Select --}}
      <div class="col">
        <x-adminlte-select name="parentGroup" label="Parent Group" label-class="info">
          <x-slot name="prependSlot">
            <div class="input-group-text bg-primary">
              <i class="fas fa-users"></i>
            </div>
          </x-slot>
          <x-adminlte-options :options="$groupsArray" :selected="[]"/>
        </x-adminlte-select>
      </div>
      
      {{-- Group Name Input --}}
      <div class="col">
        <x-adminlte-input name="groupName" placeholder="Enter group name" label="Group Name"/>
      </div>
    </div>
    
    {{-- Temporary submit button until a tool card is added. --}}
    <div class="row">
      <x-adminlte-button type="submit" theme="success" label="Submit"/>
    </div>
  </form>
</x-adminlte-card>

{{-- Full Data Table --}}
<x-adminlte-card theme="info" theme-mode="outline">
  <div class="flex-container">
    @include('users.partials.grouptable')
  </div>
</x-adminlte-card>

@stop

<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const userId = $(this).data('group-id');
            if (confirm('Are you sure you want to delete this group?')) {
                $.ajax({
                    url: '/group/' + groupId,
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
