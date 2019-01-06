<?php
$title='Clientes';
?>
@extends('layouts.app')
@section('title',$title)
@section('styles')
    <link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="row justify-content-between">
        <div class="col">
            <h1><?php echo $title;?></h1>
        </div>
        <div class="col-2">
            <button type="button" id="btn_create" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="cargarDiv('.modal-content','{{route('clientes.create')}}');">
                Nuevo <i class="fa fa-plus"></i>
            </button>
        <a href="{{route('pdfClientes')}}" type="button" id="btn_pdf" class="btn btn-danger">
                PDF <i class="fa fa-file-pdf-o"></i>
            </a>
        </div>          
    </div>   
    <hr>
    <div id="tabla">

    </div>

    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                
            </div>
        </div>
    </div>
    {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token"> --}}
@endsection
@section('script')
<script src="{{asset('js/plugins/validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var listClients = function(){
        $.ajax({
            type:'get',
            url:'{{ url('listallClients') }}',
            success: function(data){
                $('#tabla').empty().html(data);
            }
        });
    }
    $(document).on("click",".pagination li a",function (e) {
            e.preventDefault();
            var url=$(this).attr("href");
            $.ajax({
                type:'get',
                url:url,
                success:function (data) {
                    $('#tabla').empty().html(data);
                    
                }
            })
            
        });
    var eliminar=function(id){
        var id_elim=id;
        swal({
            title: "Seguro?",
            text: "Estas a punto de eliminar este cliente ",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Sí, eliminalo!",
            closeOnConfirm: false
        }, function () {
            var route = "{{url('clientes')}}/"+id_elim+"";
            $.ajax({
                url:route,
                type:'DELETE',
                dataType:'json',
                success:function(data){
                    if(data.success == 'true'){
                        listClients();
                        swal("Eliminado!", "Se ha eliminado el registro con exito.", "success");
                    }
                },
                error:function () {
                    swal({
                        title: "Error",
                        text: "Algo estubo mal.",                                
                        type: "error",
                        showConfirmButton: false,
                        timer: 900
                    });
                }
            });            
        });
    }
    
    $( document ).ready(function() {
        listClients();
    });
</script>
@endsection