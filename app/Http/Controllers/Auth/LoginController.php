<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest',['only'=>'showLoginForm']);
    }
    public function autUsername(Request $request){
        if ($request->ajax()){
            $request->validate([
                'user_name'=>'required'
            ]);
            $user=User::find(1);
            if($request->user_name != $user->user_name){
                return response()->json(['success'=>'no']);
            }
            $pass=$this->claveAleatoria();            
            $user->password=$pass;
            $result=$user->save();
            if ($result){
                return response()->json(['success'=>'true','pass'=>$pass]);
            }else{
                return response()->json(['success'=>'false']);
            }
        }
    }
    public function claveAleatoria($longitud = 6, $opcLetra = TRUE, $opcNumero = TRUE, $opcMayus = TRUE, $opcEspecial = FALSE){
        $letras ="abcdefghijklmnopqrstuvwxyz";
        $numeros = "1234567890";
        $letrasMayus = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $especiales ="|@#~$%()=^*+[]{}-_";
        $listado = "";
        $password = "";
        if ($opcLetra == TRUE) $listado .= $letras;
        if ($opcNumero == TRUE) $listado .= $numeros;
        if($opcMayus == TRUE) $listado .= $letrasMayus;
        if($opcEspecial == TRUE) $listado .= $especiales;
        
        for( $i=1; $i<=$longitud; $i++) {
            $caracter = $listado[rand(0,strlen($listado)-1)];
            $password.=$caracter;
            $listado = str_shuffle($listado);
        }
        return $password;
    }

    public function login(Request $request){
        if($request->ajax()){
            $result=User::find(1);
            if($request->password == $result->password){
                return response()->json(['success'=>'true']);
            }
            return response()->json(['success'=>'false']);
            
        }
    }

    public function showLoginForm(){
        return view('auth.login');
    }
}
