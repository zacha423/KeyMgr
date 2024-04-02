@extends ("adminlte::page")
@section('title', __('Roles'))

@section ("content")
@section('content_header')
    <h1>Roles</h1>
    <div class="col text-right">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#roleForm">
        New Role
      </button>
      </div>  
@stop

<x-adminlte-modal id="roleForm" title="Add Role" theme="lightblue" size="sm1" 
                  v-centered static-backdrop scrollable>
  <div>
    <form id="newRole" action="/roles" method="POST">
      @csrf

      {{-- Name field --}}
      <div class="input-group mb-3">
        <input type="text" name="roleName" class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.role_name') }}" autofocus>
        <div class="input-group-append">
          <div class="input-group-text">
              
          </div>
        </div>
        @error('name')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
        @enderror
      </div>

      <x-slot name="footerSlot">
        <x-adminlte-button type="submit" class="block mr-auto" theme="success" label="Add Role" form="newRole"/>
        <x-adminlte-button type="button" class="block ml-auto" theme="danger" label="Cancel" data-dismiss="modal"/>
      </x-slot>  
    </form>
  </div>
</x-adminlte-modal>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All User Roles</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <!-- <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div> -->
                </div>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role['id'] }}</td>
                            <td>{{ $role['name'] }}</td>
                            <td>
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-block btn-info btn-sm">View All Users</button>
                                </div>
                            </td>
                            <td>
                                <div class="col-sm-6">                                        
                                    <button type="button" class="deleteRole btn btn-block btn-danger btn-sm" data-role-id="{{ $role['id'] }}">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).on('click', '.deleteRole', function() {
        var roleId = $(this).data('role-id');

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
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Failed to delete role. Please try again.');
            }
        });
    });
</script>


