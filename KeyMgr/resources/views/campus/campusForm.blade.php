<h1>Context</h1>
<pre>
  It may be useful to run `php artisan migrate:fresh --seed`.
  This page has a basic form describing the set of attributes expected by the backend.
  The campus controller utilizes a wrapper to build the submodels (address, state, ...) rather than implementing several controllers.
  Available resource routes for campus that are managed by app/Http/Controlers/CampusController:
    (you can also check this using the command `php artisan route:list`)
    1. GET  /campus               : CampusController.index()   # Gets a list of campus resource objects
    2. POST /campus               : CampusController.store()   # Creates a new Campus
    3. GET  /campus/create        : CampusController.create()  # This page is a form for creating new Campus resource objects
    4. GET  /campus/{campus}      : CampusController.show()    # This page displays the full details on a specifif campus. 
                                                               # This could include other details such as buildings.
    5. GET /campus/{campus}/edit  : CampusController.edit()    # This page is a form for editing an existing Campus resource object.
    6. PUT/PATCH /campus/{campus} : CampusController.update()  # This page processes any updates to a given campus.
    7. DELETE /campus/{campus}    : CampusController.destroy() # This method deletes a campus.

  If all of these routes are not required from the frontend we do NOT have to implement them. We can disable several, or all of them.
</pre>
<h2>To Do List</h2>
Pages #1, #3, #4, and #5 tell Zach what data you want to display and I will get you a nicer output instead of raw JSON.
Pages #2, #6, and #7 send the web requests the page, and tell Zach what view needs rendered, or where to redirect to.
<h1>Form</h1>
<form method="post" action="/campus">
  @csrf
  @include('campus.addressForm')
  <div>
    <input type="text" name="name">Campus Name</input>
  </div>
  <div>
    <input type="submit"></input>
  </div>
</form>
<h1>Data fields</h1>
<p>Some fields may not show data, because of which controller method was called.</p>
@if(isset($campusesJSON))
<h2>campuses</h2>
{{ $campusesJSON }}
@endif
@if(isset($campusJSON))
<h2>campus</h2>
{{ $campusJSON }}
@endif