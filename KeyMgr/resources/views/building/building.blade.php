<h1>Context</h1>
<pre>
</pre>
<h2> To Do List</h2>
<h1>Form</h1>
<form method="post" action="/building">
  @csrf
  <div>
    <input type="text" name="name">Building Name</input>
  </div>
  @include ('campus.addressForm')
  <div>
    <input type="submit"></input>
  </div>
</form>
<h1>Data fields</h1>
<p>Some fields may not show data, because of which controller method was called.</p>
<h2>buildings</h2>
{{ $buildings }}
<h2>building</h2>
{{ $building }}