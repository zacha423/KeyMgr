<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campus Information</title>
    @vite(['resources/css/moretest.css'])
</head>
<body>
    <div class="container">
        <h1>Campus Information</h1>
        @include('campus.addressShow')
        <a href="{{ route('campus.edit', ['campus' => $campus['id']]) }}">{{ "Edit" }}</a>
    </div>
</body>
</html>
