<h1>Accounts/{account}/Edit Blade</h1>
<p>I'm the form to edit an account. I'll eventually submit a request to /accounts/{account}.</p>
<form method="post" action="/accounts">
  @csrf
  <input type="text"> test</input>
</form>
<h2>About</h2>
<p>This blade represents the form to edit a user account/profile. To use this:
  <ol><li>Tell Zach what data needs to displayed / or just take the results of the accounts/{account} (.show) API call.</li>
  <li>Send a PATCH request accounts/{account}
    <ul>
      <li>Zach will update this with more information about how to strucutre the arguments.</li>
      <li>If you start it beforehand, then copy the same attributes listed on the create blade.</li>
    </ul>
  </li>
  <li>Tell Zach where to redirect to after updating the account.
    <br>
    Currently it redirects to the main /accounts page.
  </li>
  </ol>
</p>
{{ $errors }}