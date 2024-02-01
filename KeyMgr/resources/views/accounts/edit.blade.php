<h1>Accounts/{account}/Edit Blade</h1>
<p>I'm the form to edit an account. I'll eventually submit a request to /accounts/{account}.</p>
<form method="post" action="/accounts">
  @csrf
  <input type="text"> test</input>
  <!-- <input type="submit"></input> -->
  <!-- This will be done differently to accomodate a PUT/PATCH request method.
More info to come. :) -->
</form>