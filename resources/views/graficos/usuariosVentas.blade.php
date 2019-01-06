<?php
$title='Usuarios/Ventas';
?>
@extends('layouts.app')
@section('title',$title)
@section('styles')
<style>

</style>
@endsection
@section('content')
    <h1>Gráfico de Usuarios vs Ventas</h1><hr>
    <div class="row">
        <div class="col-6">
            <canvas id="barra" height="150"></canvas>
        </div>
        <div class="col-6">
            <canvas id="dona" height="150"></canvas>
        </div>
    </div>
    
@endsection
@section('script')
<script src="{{asset('js/plugins/chartJs/Chart.min.js')}}"></script>

<script>
    function random_rgba() {
        var o = Math.round, r = Math.random, s = 255;
        return 'rgba(' + o(r()*s) + ',' + o(r()*s) + ',' + o(r()*s) + ',.4)';
    }

    var ctx = $("#barra");
    var labels=[
        @foreach ($datos as $dato)
            "{{$dato->Nombre}}",
        @endforeach
    ];
    var data=[
        @foreach ($datos as $dato)
            {{$dato->Cantidad}},
        @endforeach
    ]
    var backgroundColor=[
        @foreach ($datos as $dato)
            random_rgba(),
        @endforeach
    ]
    var myBarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels:labels,
            datasets:[{
                label: 'Cantidad de compras',
                data:data,
                backgroundColor:backgroundColor
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    stacked: true
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }
    });
    
    var ctxDona = $("#dona");
    var labelsVenta=[
        @foreach ($totalVentas as $venta)
            "{{$venta->Nombre}}",
        @endforeach
    ];
    var dataVenta=[
        @foreach ($totalVentas as $venta)
            {{$venta->total}},
        @endforeach
    ]
    var backgroundColorVenta=[
        @foreach ($totalVentas as $venta)
            random_rgba(),
        @endforeach
    ]
    var myPieChart = new Chart(ctxDona, {
        type: 'pie',
        data: {
            labels:labelsVenta,
            datasets:[{
                label: 'Total de compras',
                data:dataVenta,
                backgroundColor:backgroundColorVenta
            }]
        },
        options: {
            scales: {
                xAxes: [{
                    stacked: true
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }
    });


    $( document ).ready(function() {
        //
    });
</script>
@endsection