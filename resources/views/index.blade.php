<?php
$title='Inicio';
?>
@extends('layouts.app')
@section('title',$title)
@section('content')
    <h1>Métricas</h1><hr>
    <div class="row">
        <div class="col-lg-3">
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Total valor ventas</h5>
                    <h1 class="no-margins">{{$ventaTotal}}</h1>
                    <div class="stat-percent font-bold text-navy">98% <i class="fa fa-bolt"></i></div>
                    <small>Total income</small>
                </div>
            </div>
            <div class="ibox">
                <div class="ibox-content">
                    <h5>Ultimas facturas</h5>
                    <table class="table table-stripped table-hover small m-t-md">
                        <tbody>
                        @foreach ($ventas as $venta)
                            <tr class="clickable-row" data-href="https://www.google.com/" title="{{$venta->date}}" data-toggle="tooltip" data-placement="right">
                                <td class="">
                                    <i class="fa fa-circle text-success"></i>
                                </td>
                                <td class="text-left">
                                    {{$venta->NOMBRE_COMPLETO}}
                                </td>
                                <th class="text-right">
                                    {{$venta->TOTAL}}
                                </th>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Historial de ventas</h5>
                </div>
                <div class="ibox-content">
                    <div>
                        <canvas id="lineChart" height="100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="{{asset('js/plugins/chartJs/Chart.min.js')}}"></script>

<script>
    $( document ).ready(function() {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
        var lineData = {
            labels: [
                @foreach ($historiales as $historial)
                    "{{$historial->mes}}",                                
                @endforeach
            ],
            datasets: [

                {
                    label: "V. total:",
                    backgroundColor: 'rgba(26,179,148,0.5)',
                    borderColor: "rgba(26,179,148,0.7)",
                    pointBackgroundColor: "rgba(26,179,148,1)",
                    pointBorderColor: "#fff",
                    data: [
                    @foreach ($historiales as $historial)
                        "{{$historial->total}}",                                
                    @endforeach
                    ]
                }
            ]
        };
        var lineOptions = {
            responsive: true
        };


        var ctx = document.getElementById("lineChart").getContext("2d");
        new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
    });
</script>
@endsection