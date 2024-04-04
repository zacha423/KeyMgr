@extends ("adminlte::page")
@section('title', __('User Groups'))

@section('content_header')
    <h1>User Groups</h1>
@stop

@section('content')

@section('plugins.Datatables', true)

{{-- Limit Search Results Card --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Limit results by:" collapsible>
  <form></form>
</x-adminlte-card>

{{-- Tools Card --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Tools" collapsible>
  <x-adminlte-button type="button" theme="primary" data-toggle="modal" data-target="#roleModal" 
    id="roles" name="roles" label="Manage Roles"/>
  <x-adminlte-button type="button" theme="primary" data-toggle="modal" data-target="#userModal" 
    id="users" name="users" label="Manage Users" disabled/>
  <x-adminlte-button type="button" theme="success" data-toggle="modal" data-target="#newGroupModal" 
    id="newGroup" name="newGroup" label="Create New Group"/>
  @include('users.groups.manageRolesModal', ['title' => 'Role Permissions Management'])
  @include('users.groups.manageUsersModal')
  @include('users.groups.newGroupModal', ['options' => $groupsArray, 'title' => 'Group Creation Form'])
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