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
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
            <div class="flex justify-between items-center">
                <input type="text" id="newRoleName" placeholder="Enter role name" class="text-gray-900 dark:text-gray-100 flex-grow mr-4">
                <button onclick="addRole()" class="text-gray-900 dark:text-gray-100 flex-grow mr-4">Add Role</button>
            </div>
        </div>
    </div>

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
                    var newRoleHTML = '<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">';
                    newRoleHTML += '<div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">';
                    newRoleHTML += '<div class="flex items-center">';
                    newRoleHTML += '<div class="text-gray-900 dark:text-gray-100 flex-grow mr-4">' + roleName + '</div>';
                    newRoleHTML += '<div class="flex items-center"><div class="ml-auto flex items-center p-2">';
                    newRoleHTML += '<button class="deleteRole btn-red" data-role-id="' + response.id + '">Delete</button>';
                    newRoleHTML += '</div></div></div></div></div>';
                    
                    $('.max-w-7xl').append(newRoleHTML); 
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
            var listItem = $(this).closest('.bg-white');

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
</x-app-layout>
