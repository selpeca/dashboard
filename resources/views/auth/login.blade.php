@extends('layouts.login')
@section('content')
<div id="control">
    <form id="frm_username" class="animated bounceInRight">
        @csrf
        <div class="input-group"  id="f_user_name">
            <div class="input-group-prepend">
                <span class="input-group-addon">@</span>
            </div>
            <input type="text" placeholder="Username" class="form-control" name="user_name" id="user_name">
        </div>  
        <button id="usuario" class="btn btn-primary block full-width m-b">Validar</button>
    </form>
    <form class="d-none" id="frm_pass">
        <h3>La contraseña se ha enviado al correo</h3>
        <input type="password" placeholder="Contraseña" class="form-control" name="password" id="password">
        <button id="login" class="btn btn-primary block full-width m-b">Acceder</button>
    </form>
</div>
@endsection
@section('scripts')
<script>
    var currentRequest;
$('#frm_username').submit(function(e){
    e.preventDefault();
    if(currentRequest){
        currentRequest.abort();
    }
    currentRequest=$.ajax({
        url: "{{route('autUsername')}}",
        type:'GET',        
        datatype: 'json',
        data:$('#frm_username').serialize(),
        success:function(data){
            if(data.success == 'true'){
                enviarCorreo(data.pass);
                $('.alert-danger').fadeOut(100);
                $('#frm_username').addClass('animated').addClass('fadeOut');
                $('#frm_pass').removeAttr('class');
                $('#frm_pass').addClass('animated').addClass('bounceInRight');
                $('#frm_username').addClass('d-none');

            }else{
                swal({
                    title: "Usuario no encontrado!",
                    text: "intenta otra vez",                                
                    type: "error"
                });
            }
        },
        error:function(request, status, error){
            json = $.parseJSON(request.responseText);
            $.each(json.errors, function(key, value){
                $('#control').removeAttr('class');
                $('#control').addClass('animated');
                $('#control').addClass('shake');
                $('#f_user_name').addClass('has-error');
            });
        }
    });
});
function enviarCorreo(pass){
    var url="{{route('sendmail')}}/"+pass;
    $.ajax({
        url:url,
        type:'GET',
        datatype: 'json',
        data:{pass:pass}
    });
}
$('#frm_pass').submit(function(e){
    e.preventDefault();
    console.log($('input[name="_token"]').val());
    currentRequest=$.ajax({
        url: "{{route('login')}}",
        type:'POST',
        datatype: 'json',
        data:{
            '_token':$('input[name="_token"]').val(),
            'user_name':$('#user_name').val(),
            'password':$('#password').val()
        },
        success:function(data){
            if(data.success=='true'){
                window.location.href = "{{route('dashboard')}}";
            }else if(data.success=='no'){
                swal({
                    title: "Contraseña incorrecta!",
                    text: "intenta otra vez",                                
                    type: "error"
                });;
            }else{
                swal({
                    title: "Contraseña incorrecta!",
                    text: "intenta otra vez",                                
                    type: "error"
                });
            }
        },
        error:function(){
            console.log('Error');
        }
    });
});
</script>
    
@endsection