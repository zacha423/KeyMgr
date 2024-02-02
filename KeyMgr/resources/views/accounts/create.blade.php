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
<h2>About</h2>
<p>This blade template represents the form used to create a new User account. To create an account you need to:
  <ol>
    <li>Send a post request to /accounts/create<br>Include the following information (exact name - description):
    <ul>
      <li>firstName - the first name of the user</li>
      <li>lastName - the last name of the user</li>
      <li>username - the username for the account</li>
      <li>email - the email address for the user account</li>
      <li>password - the user's password</li>
      <li>password_confirmation - confirming the user's password</li>
    </ul>
    </li>
    <li>Tell Zach where to set the redirect path to.
      <br>Currently this only displays the results of the form to the screen after saving it to the DB.
    </li>
  </ol>
</p>