<!-- <h1>User Role Data</h1>
<form action="/roles" method="POST">
  @csrf
  <div>
    <input type="text" name="roleName">Role Name</input>
</div>
<div>
  <input type="submit"></input>
</div>
</form>
<h1>Blade Data</h1>
@if(isset($roleJSON))
<h2>role/roleJSON</h2>
{{ $roleJSON}}
@endif
@if(isset($rolesJSON))
<h2>roles/rolesJSON</h2>
{{ $rolesJSON }}
@endif -->


<x-app-layout>
    <x-slot name="header">
        <div class="p-2 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User Roles') }}
            </h2>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <ul id="dataList">
                    @foreach ($roles as $role)
                    <li class="flex items-center">
                        <div class="text-gray-900 dark:text-gray-100 flex-grow mr-4">
                            {{ $role['name'] }}
                        </div>
                        <button class="deleteRole btn-red" data-role-id="{{ $role['id'] }}">Delete</button>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <input type="text" id="newRoleName" placeholder="Enter role name">
        <button onclick="addRole()">Add Role</button>

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
                        name: roleName
                    },
                    success: function(response) {
                        $('#dataList').append('<li class="flex items-center"><div class="text-gray-900 dark:text-gray-100 flex-grow mr-4">' + roleName + '</div><button class="deleteRole btn-red" data-role-id="' + response.role_id + '">Delete</button></li>');
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
                var listItem = $(this).closest('li');


                $.ajax({
                    url: '{{ route('roles.destroy', ['role' => $role['id']]) }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: roleId
                    },
                    success: function(response) {
                        listItem.remove();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Failed to delete role. Please try again.');
                    }
                });
            });
        </script>

        <style>
            .btn-red {
                background-color: #e53e3e;
                color: #fff;
                border: none;
                padding: 0.10rem 0.25rem;
                border-radius: 0.5rem;
                cursor: pointer;
            }
        </style>
    </x-slot>
</x-app-layout>
