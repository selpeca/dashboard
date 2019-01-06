<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <i class="fa fa-laptop modal-icon"></i>
    <h4 class="modal-title">Editar productos</h4>
</div>
<div class="modal-body">
    <div id="messageBox"></div>
    <form role="form" id="form">
        {{csrf_field()}}
        <div class="form-group"><label for="nombre">Nombre</label> <input name="nombre" id="nombre" type="text"
                placeholder="Ingresa tu nombre" class="form-control" value="{{$producto->nombre}}"></div>
        <div class="form-group"><label for="stock_min">Stock min</label> <input name="stock_min" id="stock_min" type="text"
                placeholder="Ingresa el stock minimo" class="touchspin1" value="{{$producto->stock_min}}"></div>
        <div class="form-group"><label for="descripcion">Descripción</label><textarea name="descripcion" id="descripcion"
                placeholder="Descripción del producto" class="form-control">{{$producto->descripcion}}</textarea></div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
    <div>
        <button class="btn btn-sm btn-primary float-right m-t-n-xs" id="editar"><strong>Actualizar</strong></button>
    </div>
    </form>
</div>
<script>
    $("input[name='stock_min']").TouchSpin();
    var currentRequest;
    var validador = $('#form').validate({
        errorLabelContainer: "#messageBox",
        wrapper: "li",
        errorClass: "error",
        rules: {
            nombre: "required",
            stock_min: {
                required: true,
                number: true
            },
            descripcion: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            nombre: "El campo <b>Nombre</b> es requerido",
            stock_min: {
                required: "El campo <b>Stock minimo</b> es requerido",
                number: "Solo se aceptan numeros"
            },
            descripcion: {
                required: "El campo <b>Descripción</b> es requerido",
                minlength: "Minimo dos caracteres"
            }
        }
    });
    $("#editar").click(function(event){
        if (validador.form()){
            if(currentRequest) {
                currentRequest.abort();
            }
            var route = "{{route('productos.update',$producto->id)}}";
            currentRequest =$.ajax({
                    url: route,
                    type:'PUT',
                    datatype: 'json',
                    data:$('#form').serialize(),
                    success:function(data){
                        if(data.success == 'true'){
                            $("#myModal").modal('hide');
                            listProductos();
                            swal({
                                title: "Exito!",
                                text: "Producto guardado con exito!",                                
                                type: "success",
                                showConfirmButton: false,
                                timer: 900
                            });
                        }
                    },
                    error:function(data){
                        swal({
                            title: "Se produjo un error",
                            text: "Disculpa las molestias",
                            type: "error",
                            showConfirmButton: false,
                            timer: 900
                        });
                    }
                });
        }        
    });
</script>