<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceProductLot;
use App\Models\Client;
use App\Models\ProductLot;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients=Client::all();
        $product_lots=ProductLot::all();
        $num=Invoice::all();
        $num=$num->last();
        return view('vender.create',[
            'clients'=>$clients,
            'product_lots'=>$product_lots,
            'num'=>$num
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'clients_id'=>      'required',
            'date'=>            'required',
            'precio_total'=>    'required',
            'cantidad'=>        'required',
            'precio_venta'=>    'required',
            'product_lots_id'=> 'required'
        );
        $validatedData=$request->validate($rules);
        $sale=new Invoice;
        $sale->clients_id=$request->clients_id;
        $sale->date=$request->date;
        $sale->precio_total=$request->precio_total;
        $sale->user_id=1;
        $sale->save();

        for ($i=0; $i < count($request->product_lots_id); $i++) { 
            $sale_products=new InvoiceProductLot;
            $sale_products->cantidad=$request->cantidad[$i];
            $sale_products->invoices_id=$sale->id;
            $sale_products->precio_venta=$request->precio_venta[$i];
            $sale_products->product_lots_id=$request->product_lots_id[$i];
            $sale_products->save();
        }
        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
