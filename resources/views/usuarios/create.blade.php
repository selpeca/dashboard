<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
            class="sr-only">Cerrar</span></button>
    <i class="fa fa-user modal-icon"></i>
    <h4 class="modal-title">Agregar usuario al sistema</h4>
</div>
<div class="modal-body">
    <div id="messageBox"></div>
    <form role="form" id="form">
        @csrf
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-addon">@</span>
            </div>
            <input type="text" placeholder="Username" class="form-control">
        </div>          
</div>
<div class="modal-footer">
        <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
        <div>
            <button class="btn btn-sm btn-primary float-right m-t-n-xs" id="guardar"><strong>Guardar</strong></button>
        </div>
    </form>
</div>
<script>
    $(document).ready(function () {
        $('.chosen-select').chosen();
        var validador=$('#form').validate({
            errorLabelContainer: "#messageBox",
            wrapper: "li",
            errorClass:"error",
            rules:{
                primer_nombre:"required",
                primer_apellido:"required",
                num_id:{
                    required:true,
                    number:true
                }
            },
            messages:{
                primer_nombre:"El campo <b>Primer nombre</b> es requerido",
                primer_apellido:"El campo <b>Primer apellido</b> es requerido",
                num_id:{
                    required:"El campo <b>N° de identificación</b> es requerido",
                    number:"Solo se aceptan numeros"
                }
            }
        });
        var currentRequest;
        $("#guardar").click(function(event){
            if (validador.form()) {
                if(currentRequest) {
                    currentRequest.abort();
                }            
                currentRequest =$.ajax({
                    url: "{{route('clientes.store')}}",
                    type:'post',
                    datatype: 'json',
                    data:$('#form').serialize(),
                    success:function(data){
                        if(data.success == 'true'){
                            $("#myModal").modal('hide');
                            listUsers();
                            swal({
                                title: "Exito!",
                                text: "Cliente guardado con exito!",                                
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
