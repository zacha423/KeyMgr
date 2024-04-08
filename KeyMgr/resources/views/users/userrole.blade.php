@extends ("adminlte::page")
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@section('title', __('User Roles'))

@section('content_header')
    <h1>User Roles</h1>
@stop

@section('content')

@section('plugins.Datatables', true)
@section('plugins.BootStrapSwitch', true)
@section('plugins.BootStrapSelect', true)

<x-adminlte-card theme="info" theme-mode="outline" title="Tools" collapsible>
  <x-adminlte-button type="button" theme="primary" data-toggle="modal" data-target="#groupsModal" 
    id="groups" name="groups" label="Manage Groups"/>
  <x-adminlte-button type="button" theme="primary" data-toggle="modal" data-target="#userModal" 
    id="users" name="users" label="Manage Users" disabled/>
  <x-adminlte-button class="float-right" type="button" theme="success" data-toggle="modal" data-target="#newRoleModal" 
    id="newRole" name="newRole" label="Create New Role"/>
  
  @include('users.roles.manageGroupsModal', ['options' => $rolesArray])
  @include('users.partials.newRoleModal', ['title' => 'Role Creation Form'])

</x-adminlte-card>

{{-- Full Data Table --}}
<x-adminlte-card theme="info" theme-mode="outline">
  <div class="flex-container">
    @include('users.partials.roletable')
  </div>
</x-adminlte-card>

@stop

<script>
  $(document).ready(function() {
    $('.btn-delete').click(function(e) {
      e.preventDefault();
      const roleId = $(this).data('role-id');
      if (confirm('Are you sure you want to delete this role?')) {
        $.ajax({
          url: '/roles/' + roleId,
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