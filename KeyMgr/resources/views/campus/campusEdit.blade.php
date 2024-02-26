<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @vite(['resources/css/moretest.css'])
</head>
<title>Edit Campus</title>
<body>
    <div class="container">
        <h1>Edit Campus</h1>
        <form method="PATCH" action="{{ route('campus.update', ['campus' =>$campus['id']]) }}">
            @csrf
            @method('PATCH')
            
            <div class="form-group">
                <label for="name">Campus Name</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ $campus['name'] }}">
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" class="form-control" value="{{ $campus['country'] }}">
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" id="state" name="state" class="form-control" value="{{ $campus['state'] }}">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" class="form-control" value="{{ $campus['city'] }}">
            </div>
            <div class="form-group">
                <label for="streetAddress">Street Address</label>
                <input type="text" id="streetAddress" name="streetAddress" class="form-control" value="{{ $campus['streetAddress'] }}">
            </div>
            <div class="form-group">
                <label for="postalCode">Postal Code</label>
                <input type="text" id="postalCode" name="postalCode" class="form-control" value="{{ $campus['postalCode'] }}">
            </div>
            <div class="form-group">
                <input type="submit" class="button" value="Update">
            </div>
        </form>
    </div>
</body>
</html>

