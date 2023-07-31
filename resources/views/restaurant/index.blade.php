<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @foreach ($restaurants as $restaurant)
    
    <div>
        <a href="{{ route('restaurant.show', ['id' => $restaurant->id]) }}">
            {{$restaurant->name}}
        </a>
    </div>

    @endforeach
</body>
</html>