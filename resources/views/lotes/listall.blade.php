@if (count($lotes)>0)
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Stock</th>
            <th>Precio lote</th>
            <th>Precio unitario</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($lotes as $lote)
        <tr>            
            <td>{{$lote->product->nombre}}</td>
            <th>
                @if($lote->cantidad<5)
                    <span class="text-danger" title="Stock minimo {{$lote->product->stock_min}}">{{$lote->cantidad}}</span>
                @elseif($lote->cantidad<$lote->product->stock_min)
                    <span class="text-warning" title="Stock minimo {{$lote->product->stock_min}}">{{$lote->cantidad}}</span>
                @else
                    <span title="Stock minimo {{$lote->product->stock_min}}">{{$lote->cantidad}}</span>
                @endif
            </th>
            <td>
                <span class="precio_lote{{$lote->id}}"></span>
                <script>
                    fNumber.go("precio_lote{{$lote->id}}",{{$lote->precio_lote}})
                </script>
                
            </td>
            <td>
                <span class="precio_unitario{{$lote->id}}"></span>
                <script>
                    fNumber.go("precio_unitario{{$lote->id}}",{{$lote->precio_unitario}})
                </script>
            </td>
            <td>
                <a href="#" class="btn btn-info btn-circle" data-toggle="modal" data-target="#myModal" onclick="cargarDiv('.modal-content','{{route('lotes.edit',$lote->id)}}');"><i
                        class="fa fa-edit"></i></a>
                <a href="#" onclick="eliminar('{{$lote->id}}')" class="btn btn-danger btn-circle"><i class="fa fa-trash-o"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="text-center">
    {{$lotes->links()}}
</div>
@else
    <div class="alert alert-warning">
        <b>No se encontraron resultados</b>
    </div>
@endif