@extends ("adminlte::page")
@section('title', __('User Roles'))

@section('content_header')
    <h1>User Roles</h1>
@stop

@section('content')

@section('plugins.Datatables', true)

<x-adminlte-button type="button" theme="success" data-toggle="modal" data-target="#newGroupModal" 
    id="newGroup" name="newGroup" label="Create New Group"/>




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
                    url: '/role/' + roleId,
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







