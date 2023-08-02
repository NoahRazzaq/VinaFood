<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    {{$restaurant->name}}
    {{$restaurant->phone}}
    {{$restaurant->city}}

    <img src="$restaurant->image}}" alt="">


    <a class="" href="/restaurants/deleteRestaurant/{{$restaurant->id}}">Supprimer</a>
    <a class="" href="/restaurants/{{$restaurant->id}}/edit">Modifier</a>


 
</html>