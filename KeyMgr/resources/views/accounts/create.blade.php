<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Tailwind CSS (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #1e1e1e;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .form-container {
      background-color: #2b2b2b; 
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.4); 
    }
    input[type="text"],
    input[type="email"],
    input[type="password"] {
      background-color: #3e3e3e; 
      color: #d4d4d4; 
    }
    input[type="submit"] {
      background-color: #3498db; 
      color: white;
      border: none;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #2980b9; 
    }
    ::placeholder {
      color: #d4d4d4; 
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="form-container">
          <form method="post" action="/accounts">
            @csrf

            <!-- First Name -->
            <div class="form-group mb-4">
              <input name="firstName" type="text" class="form-control" placeholder="First Name" required>
            </div>

            <!-- Last Name -->
            <div class="form-group mb-4">
              <input name="lastName" type="text" class="form-control" placeholder="Last Name" required>
            </div>

            <!-- Username -->
            <div class="form-group mb-4">
              <input name="username" type="text" class="form-control" placeholder="Username" required>
            </div>

            <!-- Email -->
            <div class="form-group mb-4">
              <input name="email" type="email" class="form-control" placeholder="Email" required>
            </div>
            
            <!-- Password -->
            <div class="form-group mb-4">
              <input name="password" type="password" class="form-control" placeholder="Password" required>
            </div>

            <!-- Confirm Password -->
            <div class="form-group mb-6">
              <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm Password" required>
            </div>

            <!-- Submit -->
            <div class="flex justify-between items-center">
              <a class="text-sm text-gray-400 hover:text-gray-200" href="/">
                Already registered?
              </a>
              <div class="form-group">
                <input type="submit" value="Register" class="btn btn-primary">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
