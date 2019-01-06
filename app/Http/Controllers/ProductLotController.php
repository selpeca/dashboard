<?php

namespace App\Http\Controllers;

use App\Models\ProductLot;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductLotController extends Controller
{
    public function pdf(){
        $productLots=ProductLot::all();
        $pdf = \App::make('dompdf.wrapper');
        $pdf = \PDF::loadView('lotes.pdf', ['lotes'=>$productLots]);
        return $pdf->stream('Lotes');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listall(){
        $productLots=ProductLot::orderBy('product_id','id','DESC')->paginate(7);
        return view('lotes.listall',['lotes'=>$productLots]);
    }


    public function index()
    {
        return view('lotes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products=Product::all();
        return view('lotes.create',['products'=>$products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax())
        {
            $lot = new ProductLot;
            $lot->product_id=$request->product_id;
            $lot->cantidad=$request->cantidad;
            $lot->precio_lote=$request->precio_lote;
            $lot->precio_unitario=$request->precio_unitario;

            
            $result=$lot->save();
            if ($result){
                //Session::flash('save','Se ha creado correctamente');
                return response()->json(['success'=>'true']);
            }else{
                return response()->json(['success'=>'false']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProductLot  $productLot
     * @return \Illuminate\Http\Response
     */
    public function show(ProductLot $productLot)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProductLot  $productLot
     * @return \Illuminate\Http\Response
     */
    public function edit($productLot)
    {
        $products=Product::all();
        $lot=ProductLot::find($productLot);
        return view('lotes.edit',['lot'=>$lot,'products'=>$products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProductLot  $productLot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $productLot)
    {
        if($request->ajax()){
            $lot=ProductLot::FindOrFail($productLot);
            $input=$request->all();
            $result=$lot->fill($input)->save();

            if ($result){
                return response()->json(['success'=>'true']);
            }else{
                return response()->json(['success'=>'false']);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProductLot  $productLot
     * @return \Illuminate\Http\Response
     */
    public function destroy($productLot)
    {
        $lot=ProductLot::FindOrFail($productLot);
        $result = $lot->delete();
        if ($result)
        {
            return response()->json(['success'=>'true']);
        }
        else
        {
            return response()->json(['success'=> 'false']);
        }
    }
}
