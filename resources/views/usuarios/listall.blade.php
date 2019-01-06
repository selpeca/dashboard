@if (count($users)>0)
<table class="table table-striped">
    <thead>
        <tr>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
        <tr>            
            <td>{{$user->user_name}}</td>
            <td>{{$user->email}}</td>
            <td>
                <a href="#" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal" onclick="cargarDiv('.modal-content','{{route('usuarios.edit',$user->id)}}');"><i
                        class="fa fa-edit"></i></a>
                <a href="#" onclick="eliminar('{{$user->id}}','{{$user->username}}')" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="text-center">
    {{$users->links()}}
</div>
@else
    <div class="alert alert-warning">
        <b>Aún no existen usuarios.</b>
    </div>
@endif