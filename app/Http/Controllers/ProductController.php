<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function pdf(){
        $products=Product::all();
        $pdf = \App::make('dompdf.wrapper');
        $pdf = \PDF::loadView('productos.pdf', ['products'=>$products]);
        return $pdf->stream('Productos');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listall(){
        $products=Product::orderBy('id','DESC')->paginate(7);
        return view('productos.listall',['productos'=>$products]);
    }

    public function index()
    {
        return view('productos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.create');
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
            $product = new Product;
            $product->nombre=$request->nombre;
            $product->stock_min=$request->stock_min;
            $product->descripcion=$request->descripcion;
            // if($request->hasFile('imagen')){
            //     $imagen=$request->file('imagen');
            //     $imgbinary = fread(fopen($imagen,"r"),filesize($imagen));
            //     $product->imagen=base64_encode($imgbinary);
            // }
            
            $result=$product->save();
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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $product=Product::find($product_id);
        return view('productos.edit',["producto"=>$product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        if($request->ajax()){
            $product=Product::FindOrFail($product_id);
            $input=$request->all();
            $result=$product->fill($input)->save();

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
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $product=Product::FindOrFail($product_id);
        $result = $product->delete();
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
