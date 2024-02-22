<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Campuses</title>
    @vite(['resources/css/moretest.css'])
</head>
<body>
    <div class="container">
        <h1>List of Campuses</h1>
        <ul>
            @foreach($campuses as $campus)
                <li><a href="{{ route('campus.show', ['campus' => $campus['id']]) }}">{{ $campus['name'] }}</a></li>
            @endforeach
        </ul>
    </div>
</body>
</html>
