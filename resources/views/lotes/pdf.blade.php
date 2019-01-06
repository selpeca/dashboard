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
    <h1>Lotes</h1>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Precio lote</th>
                <th>Precio unitario</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lotes as $lote)
                <tr>            
                    <td>{{$lote->product->nombre}}</td>
                    <th>
                        @if($lote->cantidad<5)
                            <span class="text-danger">{{$lote->cantidad}}</span>
                        @elseif($lote->cantidad<$lote->product->stock_min)
                            <span class="text-warning">{{$lote->cantidad}}</span>
                        @else
                            <span>{{$lote->cantidad}}</span>
                        @endif
                    </th>
                    <td>{{$lote->precio_lote}}</td>
                    <td>{{$lote->precio_unitario}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
</body>
</html>