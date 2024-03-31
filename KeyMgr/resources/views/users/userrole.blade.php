
@extends ("adminlte::page")
@section ("content")
    <div class="p-2 flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('User Roles') }}
        </h2>
    </div>

    <!-- <div class="py-12">
        <div class="testff max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
                <input type="text" id="newRoleName" placeholder="Enter role name" class="text-black flex-grow mr-4">
                <button onclick="addRole()" class="text-gray-900 dark:text-gray-100 flex-grow mr-4">Add Role</button>
            </div>

            @foreach ($roles as $role)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
                    <div class="flex items-center">
                        <div class="text-gray-900 dark:text-gray-100 flex-grow mr-4">
                            {{ $role['name'] }}
                        </div>
                        <div class="flex items-center">
                            <div class="ml-auto flex items-center p-2">
                                <button class="deleteRole btn-red" data-role-id="{{ $role['id'] }}">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div> -->



<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">All User Roles</h3>
            <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Users</th>
                    </tr>
                </thead>
                @foreach ($roles as $role)
                <div class="test">
                <tbody>
                    <tr>
                        <td>{{ $role['id'] }}</td>
                        <td>{{ $role['name'] }}</td>
                        <td>11-7-2014</td>
                        <td>
                            <div class="flex items-center col-sm-6">
                            <div class="ml-auto flex items-center p-2">
                                <button type="button" class="deleteRole btn btn-block btn-danger btn-sm" data-role-id="{{ $role['id'] }}">Delete</button>
                            </div>
                        </div>
                        </td>
                    </tr>
                </tbody>
                </div>
                @endforeach
            </table>
        </div>
    </div>
</div>

@stop


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function addRole() {
            var roleName = $('#newRoleName').val();
            if (roleName.trim() === '') {
                alert('Please enter a role name');
                return;
            }

            $.ajax({
                url: '{{ route('roles.store') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    roleName: roleName
                },
                success: function(response) {
                    var newRoleHTML = '<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">';
                    newRoleHTML += '<div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">';
                    newRoleHTML += '<div class="flex items-center">';
                    newRoleHTML += '<div class="text-gray-900 dark:text-gray-100 flex-grow mr-4">' + roleName + '</div>';
                    newRoleHTML += '<div class="flex items-center"><div class="ml-auto flex items-center p-2">';
                    newRoleHTML += '<button class="deleteRole btn-red" data-role-id="' + response.id + '">Delete</button>';
                    newRoleHTML += '</div></div></div></div></div>';

                    $('.testff').append(newRoleHTML); 

                    $('#newRoleName').val(''); 
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                    alert('Failed to add role. Please try again.');
                }
            });
        }

        $(document).on('click', '.deleteRole', function() {
            var roleId = $(this).data('role-id');
            var listItem = $(this).closest('test');

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

    <style>
        .deleteRole {
            width: 20px;
        }
    </style>