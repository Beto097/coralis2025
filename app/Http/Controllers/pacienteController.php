<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\paciente;

use Session;

class pacienteController extends Controller
{
    public function index(){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/paciente')){
                        
            if (Auth::user()->rol->tipo_rol == 1) {
                $resultado = paciente::get(); 
            } else {
                $resultado=paciente::where('estado_paciente',1)->get();
            }

            return view ("paciente.index", ["resultado"=>$resultado]);
            
        }

        return redirect(route('index'));
    }

    public function consultar($cedula){

        if (!Auth::user()) {

            return 'no tienes acceso';
        }
        $valor= array();
        $existe = paciente::where('identificacion_paciente',$cedula)->count();
        if($existe ==1){
            $paciente = paciente::where('identificacion_paciente',$cedula)->first();
            $valor= array("cedula"=>$cedula,"nombre"=>$paciente->nombre_paciente." ".$paciente->apellido_paciente); 
            
        }

        return $valor;
    }

    public function buscar(){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/paciente')){                        
            

            return view ("paciente.buscar");
            
        }

        return redirect(route('index'));
    }

    public function search(Request $request){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/paciente')){        

            $keyWord = '%'.$request->txtBuscar.'%';

            return view("paciente.index", [
                'resultado' => paciente::latest()
    
                            ->where(function ($query) use ($keyWord){
                                $query->orWhere('identificacion_paciente', 'LIKE', $keyWord)
                                ->orWhere('nombre_paciente', 'LIKE', $keyWord)
                                ->orWhere('apellido_paciente', 'LIKE', $keyWord)
                                ->orWhere(DB::raw("CONCAT(nombre_paciente,' ',apellido_paciente)"), 'LIKE', str_replace(" ", "%", $keyWord));
                            
                            })
                            
                            ->get(),
                ]); 
            
        }

        return redirect(route('index'));
    }
}
