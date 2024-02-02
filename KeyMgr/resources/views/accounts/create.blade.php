<h1>Accounts/Create Blade</h1>
<p>This blade is a form to create an account.   
  It was created using a default resource controller.</p>
<form method="post" action="/accounts">
  @csrf
  <input name="firstName" type="text">firstName</input>
  <input name="lastName" type="text">lastName</input>
  <input name="username" type="text">username</input>
  <input name="email" type="email">email</input>
  <input name="password" type="password">password</input>
  <input name="password_confirmation" type="password">confirm password</input>
  <input type="submit"></input>
</form>