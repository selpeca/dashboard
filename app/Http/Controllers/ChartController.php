<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Invoice;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function users_invoices(Request $request){
        $datos=DB::table('invoices')
            ->join('clients','invoices.clients_id','clients.id')
            ->select(DB::raw('clients.primer_nombre AS Nombre,COUNT(invoices.id) As Cantidad'))
            ->whereRaw('invoices.date BETWEEN (?) and (?)',[$request->fec_inicial,$request->fec_final])
            ->groupBy('clients.id','clients.primer_nombre')
            ->get();
        $totalVentas=DB::table('invoices')
            ->join('clients','invoices.clients_id','clients.id')
            ->select(DB::raw('clients.primer_nombre AS Nombre,ROUND(SUM(invoices.precio_total),0) AS total'))
            ->whereRaw('invoices.date BETWEEN (?) and (?)',[$request->fec_inicial,$request->fec_final])
            ->groupBy('clients.id','clients.primer_nombre')
            ->get(); 
        return view('graficos.usuariosVentas',['datos'=>$datos,'totalVentas'=>$totalVentas]);
    }
}
