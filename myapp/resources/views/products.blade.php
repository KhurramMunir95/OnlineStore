<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Products</h1>
                
        @foreach($product as $item)
        {
           {{$item}}
           
        }
        @endforeach
        
    </div>
    <!-- {{$product->links()}} -->
    TotalItems: <b>{{$product->count()}}</b>
</body>
</html>