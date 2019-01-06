<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
            class="sr-only">Cerrar</span></button>
    <i class="fa fa-laptop modal-icon"></i>
    <h4 class="modal-title">Agregar productos</h4>
</div>
<div class="modal-body">
    <div id="messageBox"></div>
    <form role="form" id="form">
        @csrf
        <div class="form-group"><label for="nombre">Nombre</label> <input name="nombre" id="nombre" type="text" placeholder="Ingresa tu nombre" class="form-control"></div>
        <div class="form-group"><label for="stock_min">Stock min</label> <input name="stock_min" id="stock_min" type="text" placeholder="Ingresa el stock minimo" class="touchspin1"></div>
        <div class="form-group"><label for="descripcion">Descripción</label><textarea name="descripcion" id="descripcion" placeholder="Descripción del producto" class="form-control"></textarea></div>        
        {{-- <div class="custom-file">
            <input disabled id="imagen" name="imagen" type="file" class="custom-file-input" onchange="return cambiarFile();"  accept="image/*">
            <label for="imagen" class="custom-file-label">Selecciona una imágen</label>
        </div>  --}}
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
        <div>
            <button class="btn btn-sm btn-primary float-right m-t-n-xs" id="guardar"><strong>Guardar</strong></button>
        </div>
    </form>
</div>
<script>
    // $('.custom-file-input').on('change', function() {
    //     let fileName = $(this).val().split('\\').pop();
    //     $(this).next('.custom-file-label').addClass("selected").html(fileName);
    // });
    // function cambiarFile(){
    //     const input = document.getElementById('imagen');
    //     if(input.files && input.files[0]){
    //         console.log("File Seleccionado : ", input.files[0]);
    //     }
    // }
    $(document).ready(function () {
        $("input[name='stock_min']").TouchSpin();
        var validador=$('#form').validate({
            errorLabelContainer: "#messageBox",
            wrapper: "li",
            errorClass:"error",
            rules:{
                nombre:"required",
                stock_min:{
                    required:true,
                    number:true
                },
                descripcion:{
                    required: true,
                    minlength: 2
                }
            },
            messages:{
                nombre:"El campo <b>Nombre</b> es requerido",
                stock_min:{
                    required:"El campo <b>Stock minimo</b> es requerido",
                    number:"Solo se aceptan numeros"
                },
                descripcion:{
                    required: "El campo <b>Descripción</b> es requerido",
                    minlength: "Minimo dos caracteres"
                }
            }
        });
        var currentRequest;
        $("#guardar").click(function(event){
            var token=$('#token').val();
            if (validador.form()) {
                if(currentRequest) {
                    currentRequest.abort();
                }            
                currentRequest =$.ajax({
                    url: "{{route('productos.store')}}",
                    type:'post',
                    headers: {'X-CSRF-TOKEN': token},
                    datatype: 'json',
                    data:$('#form').serialize(),
                    beforeSend:function(){
                        //console.log("Cargando....");
                    },
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
    });
</script>
