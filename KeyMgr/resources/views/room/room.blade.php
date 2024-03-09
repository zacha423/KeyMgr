<h1>Context</h1>
<pre>
  It may be useful to run 'php artisan migrate:fresh --seed'.
  This page has a basic form describing the set of attributes expected by the backend.
  The Building controller utilizes a wrapper to build submodels rather than implementing several controllers.
  Available resource routes for Room that are managed by app/Http/Controllers/RoomControler:
    (you can also check this using the command 'php artisan route:list')
    1. GET /room
    2. POST /room
    3. GET /room/create
    4. GET /room/{room}
    5. GET /room/{room}/edit
    6. PUT/PATCH /room/{room}
    7. DELETE /room/{room}
</pre>
<h2> To Do List</h2>
<ul>
  <li>Determine how to track building/campus on the form.<br>Buildings are specific to individual campuses.</li>
</ul>
<h1>Form</h1>
<form method="post" action="/room">
  @csrf
  <div>
    Campus (limit selectable buildings to particular selected campus)
    <select name="campus">
      @if(isset($campuses))
      @foreach($campuses as $c)
      <option value="{{$c['id']}}">{{$c['name']}}</option>
      @endforeach
      @endif
    </select>
  </div>
  <div>
    Building
    <select name="building">
      @if(isset($buildings))
      @foreach($buildings as $b)
      <option value="{{$b['id']}}">{{$b['name']}}</option>
      @endforeach
      @endif
    </select>
  </div>
  <div>
    Room:<br>
    <input type="text" name="number">Room Number</input>
  </div>
  <div>
    <input type="text" name="roomDesc">Description/Notes</input>
  </div>
  Door:<br>
  @include('door.doorForm')


  <input type="submit"></submit>
</form>
<h1>Data Fields</h1>
<p>Some fields may not show data or be visible depending on which controller method was called.</p>
<pre><b>Additionally:</b>There are 2 fields. 'a', and 'aJSON'.
  'a': Is a standard array containing the data. Use this in your template.
  'aJSON': Is a JSON string used to list the keys/sample data that 'a' contains.

  Once the frontend is complete, or the reference is no longer needed the raw 
  JSON data can be removed from the template and controller.
</pre>
@if(isset($campusesJSON))
<h2>campuses/campusesJSON</h2>
{{ $campusesJSON }}
@endif
@if(isset($buildingsJSON))
<h2>buildings/buildingsJSON</h2>
{{ $buildingsJSON }}
@endif
@if(isset($buildingJSON))
<h2>building/buildingJSON</h2>
{{ $buildingJSON }}
@endif
@if(isset($roomsJSON))
<h2>rooms/roomsJSON</h2>
{{ $roomsJSON }}
@endif
@if(isset($roomJSON))
<h2>room/roomJSON</h2>
{{ $roomJSON }}
@endif
@if(isset($doorJSON))
<h2>door/doorJSON</h2>
{{ $doorJSON }}
@endif