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

    public function insert(Request $request){
        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }


        if(Auth::user()->accesoRuta('/paciente/create')){//solo modificar la ruta buscar las rutas en web.php o el la tabla pantallas
                //esto ya estaba 
            $existe = paciente::where('identificacion_paciente', $request->txtcedula)->count();
            if($existe == 1){
                return back()->withInput()->withErrors(['status' => "La cédula que quiere ingresar ya se encuentra registrada en el sistema, ingrese una diferente!"]);
            }else{
                $obj_paciente = new paciente();
                $obj_paciente->identificacion_paciente = $request->txtCedula;
                $obj_paciente->nombre_paciente = strtoupper($request->txtnombre);
                $obj_paciente->apellido_paciente = strtoupper($request->txtapellido);
                $obj_paciente->sexo_paciente = $request->txtsexo;
                $obj_paciente->fecha_nacimiento_paciente = $request->txtfecnac;
                $obj_paciente->telefono_paciente = $request->txttelefono;
                $obj_paciente->estado_civil_paciente = $request->txtEstadoCivil;
                $obj_paciente->lugar_trabajo = $request->txtTrabajo;
                $obj_paciente->direccion_paciente = $request->txtDireccion;
                $obj_paciente->email_paciente =  strtolower($request->txtemail);
                $obj_paciente->comentario_paciente = nl2br($request->txtComentario);
                $obj_paciente->save();


                if($request->esModal){
                    if($request->esModal==2){
                        return redirect()->back()->with(['txtCedula'=>$request->txtCedula,'txtRegistro'=>$request->txtRegistro]);
                    }
                }
                return redirect()->back()->withErrors(['status' => "Se Agregó el Nuevo Paciente " .$obj_paciente->identificacion_paciente]); 
            }

        }
        
            
        return redirect(route('index'));          
       

        
    }
}
