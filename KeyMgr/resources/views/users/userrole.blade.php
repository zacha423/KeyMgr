<h1>User Role Data</h1>
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
@endif