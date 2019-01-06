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
    <h1>Usuarios</h1>
    <hr>
    <table class="table table-striped">
            <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Correo</th>
                </tr>
            </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>            
                    <td>{{$user->user_name}}</td>
                    <td>{{$user->email}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>