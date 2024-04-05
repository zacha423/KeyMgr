@extends ("adminlte::page")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('title', __('User Groups'))

@section('content_header')
    <h1>User Groups</h1>
@stop

@section('content')

@section('plugins.Datatables', true)
@section('plugins.BootStrapSwitch', true)
@section('plugins.BootStrapSelect', true)

{{-- Limit Search Results Card --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Limit results by:" collapsible>
  <form>
    <x-group-selector id="groupSelect" :options="$groupsArray" :selected="$selected"></x-group-selector>
    <x-adminlte-button type="submit" theme="primary" label="Refine Search"/>
  </form>
</x-adminlte-card>

{{-- Tools Card --}}
<x-adminlte-card theme="info" theme-mode="outline" title="Tools" collapsible>
  <x-adminlte-button type="button" theme="primary" data-toggle="modal" data-target="#roleModal" 
    id="roles" name="roles" label="Manage Roles"/>
  <x-adminlte-button type="button" theme="primary" data-toggle="modal" data-target="#userModal" 
    id="users" name="users" label="Manage Users" disabled/>
  <x-adminlte-button class="float-right" type="button" theme="success" data-toggle="modal" data-target="#newGroupModal" 
    id="newGroup" name="newGroup" label="Create New Group"/>
  @include('users.groups.manageRolesModal', ['title' => 'Role Permissions Management', 'options' => $groupsArray])
  @include('users.groups.manageUsersModal', [])
  @include('users.groups.newGroupModal', ['options' => $groupsArray, 'title' => 'Group Creation Form'])
</x-adminlte-card>

{{-- Full Data Table --}}
<x-adminlte-card theme="info" theme-mode="outline">
  <div class="flex-container">
    @include('users.partials.grouptable', ['groups' => $groups])
  </div>
</x-adminlte-card>

<script>
  // This doesn't work - it's not clear why, so the buttons are disabled in the controller.
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            const groupId = $(this).data('group-id');
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
@stop