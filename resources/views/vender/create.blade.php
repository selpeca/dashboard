<?php
$title='Vender';
?>
@extends('layouts.app')
@section('title',$title)
@section('styles')
<link href="{{asset('css/plugins/chosen/bootstrap-chosen.css')}}" rel="stylesheet">
<link href="{{asset('css/plugins/touchspin/jquery.bootstrap-touchspin.min.css')}}" rel="stylesheet">    
<link rel="stylesheet" href="{{asset('css/jqueryUi/jquery-ui.min.css')}}">
<style>

</style>
@endsection
@section('content')
<form id="frm_venta" method="POST" action="{{route('vender.store')}}">
@csrf
<div class="row justify-content-between">
    <div class="col">
        <h1><?php echo $title;?></h1>
    </div>
    <div class="col-2">
        <button type="button" id="btn_create" class="btn btn-primary" data-toggle="modal" data-target="#myModal" onclick="cargarDiv('.modal-content','{{route('clientes.create')}}');">
            Cliente <i class="fa fa-plus"></i>
        </button>
    </div>          
</div>   
<hr>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="form-group col-md-6">
            <label for="clients_id">Cliente</label>
            <select name="clients_id" id="clients_id" data-placeholder="Escoge una opcion" class="chosen-select" tabindex="2">
                @foreach ($clients as $client)
                    <option value="{{$client->id}}">{{$client->primer_nombre}} {{$client->primer_apellido}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="date">Fecha</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="form-group col-md-4">
            <input type="hidden" id="inp_id">
            <label for="inp_product">Productos</label>
            <input type="text" class="form-control" id="inp_product" placeholder="Comienza a escribir...">
        </div>
        <div class="form-group col-md-4">
            <label for="inp_price">Precio unitario</label>
            <input type="text" name="inp_price" id="inp_price" class="form-control">
        </div>
        <div class="form-group col-md-2">
                <label for="inp_quantity">Cantidad</label>
                <input type="text" name="inp_quantity" id="inp_quantity" class="form-control">
        </div>
        <div class="col align-items-end">
            <a href="#" id="agregar" class="btn btn-success btn-sm btn-circle"><i class="fa fa-plus"></i></a>

        </div>
    </div>
    <table class="table table-hover">
        <thead>
            <th>Producto</th>
            <th>Precio unitario</th>
            <th>Cantidad</th>
            <th class="col-2">Subtotal</th>
            <th>Acción</th>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
            <th colspan="3">Total</th>
            <th><input type="number" name="precio_total" id="total" value="0" readonly class="form-control"></th>
        </tfoot>        
    </table>
    <button type="submit" class="btn btn-success">Confirmar</button>
    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">                
            </div>
        </div>
    </div>
</form>
@endsection
@section('script')
<script src="{{asset('js/plugins/validate/jquery.validate.min.js')}}"></script>
<script src="{{asset('js/plugins/jasny/jasny-bootstrap.min.js')}}"></script>
<script src="{{asset('js/plugins/touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>
<script src="{{asset('js/plugins/jqueryUi/jquery-ui.min.js')}}"></script>
<script src="{{asset('js/plugins/chosen/chosen.jquery.js')}}"></script>
<script>
    var currentRequest;
    function calcularTotalVenta(num=2){
        var total=parseInt($('#total').val())+parseInt(num);
        $('#total').val(total);
    }
    var este;
    $( document ).ready(function() {
        $('.chosen-select').chosen();
        var products = [
            @foreach($product_lots as $product)
                   {
                       id: "{{$product->id}}",
                       value: "{{$product->product->nombre}}",
                       price: "{{$product->precio_unitario}}"
                   },
            @endforeach
        ];//Array que almacena todos los productos con su id, nombre y precio
        $("#inp_product").autocomplete({//Inicializamos autocomplete de jqueryui
            minLength: 0,//Que cuando se escriba mas de 0 letras se active
            source: products,//Pasamos el array de todos los productos
            focus: function (event, ui) {//Cuando pasamos el mouse sobre las opciones que nos brinda autocomplete
                $("#inp_product").val(ui.item.label);//Que el input tome como valor el que estemos enfocando
                return false;
            },
            select: function (event, ui) {//Evento al seleccionar un producto
                $("#inp_product").val(ui.item.label);//Le damos el valor al input del nombre
                $("#inp_price").val(ui.item.price);//Le damos el valor al input del precio
                $("#inp_id").val(ui.item.id);//Le damos el valor al input oculto del id
                return false;
            }
        });

        $("input[name='quantity']").TouchSpin();
        $("#date").val(hoy());
    });
    $("#agregar").click(function (e) {
           e.preventDefault();
           var num=($("#inp_price").val())*($("#inp_quantity").val());
           $("tbody").append(
               "<tr><td><input type='hidden' name='product_lots_id[]' value='"+$("#inp_id").val()+"'/>"+$("#inp_product").val()+"</td>"+
               "<td><input type='hidden' name='precio_venta[]' value='"+$("#inp_price").val()+"'/>"+$("#inp_price").val()+"</td>"+
               "<td><input type='hidden' name='cantidad[]' value='"+$("#inp_quantity").val()+"'/>"+$("#inp_quantity").val()+"</td>"+
               "<td>"+num+"</td></tr>"// +
            //    "<td><a href='#' class='btn btn-danger'>-</a></td>"
           );
            calcularTotalVenta(num);

       });
    $("#eliminar").click(function(e){

    });


       

</script>
@endsection