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
    <p><strong>Country:</strong> {{ $campus['country'] }}</p>
    <p><strong>State:</strong> {{ $campus['state'] }}</p>
    <p><strong>City:</strong> {{ $campus['city'] }}</p>
    <p><strong>Street Address:</strong> {{ $campus['streetAddress'] }}</p>
    <p><strong>Postal Code:</strong> {{ $campus['postalCode'] }}</p>
</body>
</html>
