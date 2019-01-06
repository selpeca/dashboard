<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alertasProductos=DB::table('products')->select('products.nombre','products.stock_min','product_lots.precio_lote','product_lots.cantidad')->join('product_lots','product_lots.product_id','products.id')->get();
        $historiales=DB::table('invoices')->select(DB::raw('MONTHNAME(invoices.date) as mes, sum(invoices.precio_total) as total'))
                                        ->groupBy('mes')->get();
        $ventaTotal=DB::table('invoices')->sum('precio_total');
        $ventas=DB::table('invoices')->select(DB::raw('invoices.id, CONCAT(clients.primer_nombre," ",clients.primer_apellido) AS NOMBRE_COMPLETO,invoices.date,CONCAT("$ ",FORMAT(invoices.precio_total,"###,###.###.###")) as TOTAL'))->join('clients','clients.id','invoices.clients_id')->orderBy('invoices.date', 'desc')->get();
        return view('index',['ventaTotal'=>$ventaTotal,'historiales'=>$historiales,'alertasProductos'=>$alertasProductos,'ventas'=>$ventas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
