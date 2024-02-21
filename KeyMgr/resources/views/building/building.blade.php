<h1>Context</h1>
<pre>
  It may be useful to run 'php artisan migrate:fresh --seed'.
  This page has a basic form describing the set of attributes expected by the backend.
  The Building controller utilizes a wrapper to build submodel rather than implementing several controllers.
  Available resource routes for campus that are managed by app/Http/Controllers/CampusController:
    (you can also check this using the command `php artisan route:list`)
    1. GET /building
    2. POST / building
    3. GET /building/create
    4. GET /building/{building}
    5. GET /building/{building}/edit
    6. PUT/PATCH /building/{building}
    7. DELETE /building/{building}
</pre>
<h2> To Do List</h2>
<h1>Form</h1>
<form method="post" action="/building">
  @csrf
  <div>
    <select name="campus">
    @if(isset($campus))  
    @foreach($campus as $c)
      <option value="{{$c['id']}}">{{$c['name']}}</option>
    @endforeach
    @endif
  </select>
  </div>
  <div>
    <input type="text" name="name">Building Name</input>
  </div>
  @include ('campus.addressForm')
  <div>
    <input type="submit"></input>
  </div>
</form>
<h1>Data fields</h1>
<p>Some fields may not show data, depending on which controller method was called.</p>
<pre><b>Additionally:</b> There are 2 fields. 'a' and 'aJSON'. 
  aJSON is provided to give you an idea of what keys are available. This is a raw JSON string. 
  Use the regular 'a' object instead for any real tasks.

  Once the frontend is complete, or it is no longer needed for reference the raw JSON data can be 
  removed from the template and controller.
</pre>
@if(isset($buildingsJSON))
<h2>buildings/buildingsJSON</h2>
{{$buildingsJSON}}
@endif
@if(isset($buildingJSON))
<h2>building/buildingJSON</h2>
{{ $buildingJSON }}
@endif
@if(isset($campusJSON))
<h2>campus/campusJSON</h2>
{{$campusJSON}}
@endif