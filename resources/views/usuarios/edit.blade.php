<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                class="sr-only">Cerrar</span></button>
        <i class="fa fa-users modal-icon"></i>
        <h4 class="modal-title">Editar cliente</h4>
    </div>
    <div class="modal-body">
        <div id="messageBox"></div>
        <form role="form" id="form">
            @csrf
            <div class="row">
                <div class="form-group col-md-6"><label for="primer_nombre">Primer nombre</label> <input name="primer_nombre" id="primer_nombre" type="text" class="form-control" value="{{$client->primer_nombre}}"></div>
                <div class="form-group col-md-6"><label for="segundo_nombre">Segundo nombre</label> <input name="segundo_nombre" id="segundo_nombre" type="text" class="form-control" value="{{$client->segundo_nombre}}"></div>
            </div>
            <div class="row">
                <div class="form-group col-md-6"><label for="primer_apellido">Primer apellido</label> <input name="primer_apellido" id="primer_apellido" type="text" class="form-control" value="{{$client->primer_apellido}}"></div>
                <div class="form-group col-md-6"><label for="segundo_apellido">Segundo apellido</label> <input name="segundo_apellido" id="segundo_apellido" type="text" class="form-control" value="{{$client->segundo_apellido}}"></div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="tip_id">Identificación</label>
                    <select name="tip_id" id="tip_id" data-placeholder="Escoge una opcion" class="chosen-select" tabindex="2">
                        <option value="CC">Cedula</option>
                        <option value="TI">Tarjeta de identidad</option>
                        <option value="TP">TP</option>
                        <option value="RC">Registro civil</option>
                        <option value="CE">Cedula de extranjeria</option>
                        <option value="CI">CI</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="num_id">N° de identificación</label> <input name="num_id" id="num_id" type="text" class="form-control" value="{{$client->num_id}}">
                </div>
            </div>
            <div class="form-group"><label for="tel">Teléfono</label><input data-mask="(999) 999-9999" name="tel" id="tel" type="text" class="form-control" value="{{$client->tel}}"></div>
                   
    </div>
    <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Cerrar</button>
            <div>
                <button class="btn btn-sm btn-primary float-right m-t-n-xs" id="editar"><strong>Actualizar</strong></button>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $('#tip_id').val('{{$client->tip_id}}');
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
        $("#editar").click(function(event){
            if (validador.form()){
                if(currentRequest) {
                    currentRequest.abort();
                }
                var route = "{{route('clientes.update',$client->id)}}";
                currentRequest =$.ajax({
                        url: route,
                        type:'PUT',
                        datatype: 'json',
                        data:$('#form').serialize(),
                        success:function(data){
                            if(data.success == 'true'){
                                $("#myModal").modal('hide');
                                listClients();
                                swal({
                                    title: "Exito!",
                                    text: "Cliente editado con exito!",                                
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
    