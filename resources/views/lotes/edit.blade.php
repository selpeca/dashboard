<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                class="sr-only">Cerrar</span></button>
        <i class="fa fa-barcode modal-icon"></i>
        <h4 class="modal-title">Editar un lote</h4>
    </div>
    <div class="modal-body">
        <div id="messageBox"></div>
        <form role="form" id="form">
            @csrf
            <div class="form-group">
                <label for="product_id">Producto</label>
                <input name="product_id" id="product_id" class="form-control" type="text" value="{{$lot->product->nombre}}" disabled>
                    
            </div>
            <div class="form-group"><label for="cantidad">Cantidad</label> <input name="cantidad" id="cantidad" type="text" placeholder="Ingresa la cantidad" value="{{$lot->cantidad}}"></div>
            <div class="form-group"><label for="precio_lote">Precio lote</label> <input name="precio_lote" id="precio_lote" type="text" placeholder="Ingresa el precio del lote" value="{{$lot->precio_lote}}"></div>
            <div class="form-group"><label for="precio_unitario">Precio unitario</label><input name="precio_unitario" id="precio_unitario" type="text" placeholder="Ingresa el precio unitario" value="{{$lot->precio_unitario}}"></div>        
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            <div>
                <button class="btn btn-sm btn-primary float-right m-t-n-xs" id="editar"><strong>Actualizar</strong></button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $('.chosen-select').chosen();
            $("input[name='cantidad']").TouchSpin();
            $("input[name='precio_lote']").TouchSpin({
                min: 0,
                max: 999999999999999999,
                step: 1000,
                prefix: '$'
            });
            $("input[name='precio_unitario']").TouchSpin({
                min: 0,
                max: 999999999999999999,
                step: 1000,
                prefix: '$'
            });        
            var validador=$('#form').validate({
                errorLabelContainer: "#messageBox",
                wrapper: "li",
                errorClass:"error",
                rules:{
                    product_id:"required",
                    cantidad:{
                        required:true,
                        number:true
                    },
                    precio_lote:{
                        required:true,
                        number:true
                    },
                    precio_unitario:{
                        required:true,
                        number:true
                    }
                },
                messages:{
                    product_id:"El campo <b>Producto</b> es requerido",
                    cantidad:{
                        required:"El campo <b>Cantidad</b> es requerido",
                        number:"Solo se aceptan numeros"
                    },
                    precio_lote:{
                        required: "El campo <b>Precio lote</b> es requerido",
                        number:"Solo se aceptan numeros"
                    },
                    precio_unitario:{
                        required: "El campo <b>Precio unitario</b> es requerido",
                        number:"Solo se aceptan numeros"
                    }
                }
            });
        
    var currentRequest;
    $("#editar").click(function(event){
        if (validador.form()){
            if(currentRequest) {
                currentRequest.abort();
            }
            var route = "{{route('lotes.update',$lot->id)}}";
            currentRequest =$.ajax({
                    url: route,
                    type:'PUT',
                    datatype: 'json',
                    data:$('#form').serialize(),
                    success:function(data){
                        if(data.success == 'true'){
                            $("#myModal").modal('hide');
                            listLotes();
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
});
    </script>    