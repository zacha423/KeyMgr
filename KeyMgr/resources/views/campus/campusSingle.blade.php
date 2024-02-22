<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Information</title>
</head>
<body>
    <h1>Campus Information</h1>
    <p><strong>Name:</strong> {{ $campus['name'] }}</p>
    <p><strong>Address:</strong> {{ $campus['address']['streetAddress'] }}, {{ $campus['address']['city'] }}, {{ $campus['address']['state'] }}, {{ $campus['address']['country'] }}, {{ $campus['address']['postalCode'] }}</p>
</body>
</html>

