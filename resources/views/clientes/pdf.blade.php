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
    <h1>Clientes</h1>
    <hr>
    <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Identificación</th>
                    <th>N°</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clients as $client)
                <tr>            
                    <td>{{$client->primer_nombre}} {{$client->segundo_nombre}}</td>
                    <td>{{$client->primer_apellido}} {{$client->segundo_apellido}}</td>
                    <td>{{$client->tip_id}}</td>
                    <td>{{$client->num_id}}</td>
                    <td>{{$client->tel}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
</body>
</html>