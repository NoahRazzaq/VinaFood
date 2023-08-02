<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{$product->name}}</h1>
    <div>
        <div>
            {{$product->price}}
        </div>
        <div>{{$product->detail}}
</div>
       
    </div>

    <div>
        <img src="{{$product->image}}" alt="">
    </div>

    <div>
        {{$product->restaurant->name}}
    </div>
    @if ($product->category != null)
       category : {{$product->category->name}}
    @endif
   

    <a class="" href="/products/deleteProduct/{{$product->id}}">Supprimer</a>
    <a class="" href="/products/{{$product->id}}/edit">Modifier</a>


</body>
</html>