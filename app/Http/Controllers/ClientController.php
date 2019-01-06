<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function pdf(){
        $clients=Client::all();
        $pdf = \App::make('dompdf.wrapper');
        $pdf = \PDF::loadView('clientes.pdf', ['clients'=>$clients]);
        return $pdf->stream('Clientes');
    }

    public function listall(){
        $clients=Client::orderBy('id','DESC')->paginate(7);
        return view('clientes.listall',['clients'=>$clients]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('clientes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
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
            $result=Client::create($request->all());
            if ($result){
                return response()->json(['success'=>'true']);
            }else{
                return response()->json(['success'=>'false']);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($client_id)
    {
        $client=Client::find($client_id);
        return view('clientes.edit',["client"=>$client]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$client_id)
    {
        if($request->ajax()){
            $client=Client::FindOrFail($client_id);
            $input=$request->all();
            $result=$client->fill($input)->save();
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
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($client_id)
    {
        $client=Client::FindOrFail($client_id);
        $result = $client->delete();
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
