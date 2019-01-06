@if (count($clients)>0)
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
            <td>
                <a href="#" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal" onclick="cargarDiv('.modal-content','{{route('clientes.edit',$client->id)}}');"><i
                        class="fa fa-edit"></i></a>
                <a href="#" onclick="eliminar('{{$client->id}}','{{$client->nombre}}')" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="text-center">
    {{$clients->links()}}
</div>
@else
    <div class="alert alert-warning">
        <b>Aún no existen clientes.</b>
    </div>
@endif