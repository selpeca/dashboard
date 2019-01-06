<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <style>
    h1{
        font-family: 'Courier New', Courier, monospace;
    }
    </style>
</head>
<body>
    <h1>Productos</h1>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Stock min</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $producto)
            <tr>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->stock_min}}</td>
                <td>{{$producto->descripcion}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>