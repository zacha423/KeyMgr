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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add or Delete Roles</title>
</head>
<body>

    <h1>Add or Delete Roles</h1>

    <ul id="dataList">
        @foreach ($roles as $role)
            <li>
                {{ $role['name'] }}
                <button class="deleteRole" data-role-id="{{ $role['id'] }}">Delete</button>
            </li>
        @endforeach
    </ul>

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
                    $('#dataList').append('<li>' + roleName + '<button class="deleteRole" data-role-id="' + response.role_id + '">Delete</button></li>');
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

</body>
</html>
