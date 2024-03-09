<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Campus</title>
    @vite(['resources/css/moretest.css'])
</head>
<body>
    <div class="container">
        <h1>Add Campus</h1>
        <form method="post" action="{{ route('campus.store') }}">
            @csrf
            @include('campus.addressForm')
            <div class="form-group">
                
                <input type="text" id="name" name="name" class="form-control">Campus Name</input>
            </div>
            <div class="form-group">
                <input type="submit" class="button" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>
