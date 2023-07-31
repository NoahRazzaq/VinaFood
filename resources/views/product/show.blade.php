<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div>
        <div>
            {{$product->price}}
        </div>
        <div>{{$product->detail}}
</div>
        <div>{{$product->name}}
</div>
    </div>

    <div>
        {{$product->restaurant->name}}
    </div>

    <a class="" href="/products/deleteProduct/{{$product->id}}">Supprimer</a>
    <a class="" href="/products/{{$product->id}}/edit">Modifier</a>


</body>
</html>