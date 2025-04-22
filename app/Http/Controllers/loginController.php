<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\rol;
use App\Models\paciente;
use App\Models\consulta;
use App\Models\orden_laboratorio;
use App\Models\examen_orden_laboratorio;

use Carbon\Carbon;
use Session;

class loginController extends Controller
{
    public function dashboard(){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
            
        }        

     
        $consultas = consulta::whereIn('estado_consulta', ['TERMINADA', 'CERRADA'])
        ->where('fecha_consulta','>',Carbon::today()->subMonth(1)->toDateString())
        ->groupBy('medico_id')
        ->selectRaw('count(*) as total, medico_id,CAST((RAND()*100)+156 as UNSIGNED) as A,CAST((RAND()*100)+156 as UNSIGNED) as B')
        ->get();

        $consultasD = consulta::whereIn('estado_consulta', ['TERMINADA', 'CERRADA'])
        ->whereBetween('created_at', [Carbon::now('America/Panama')->startOfDay(), Carbon::now('America/Panama')->endOfDay()])
        ->groupBy('medico_id')
        ->selectRaw('count(*) as total, medico_id,CAST((RAND()*100)+156 as UNSIGNED) as A,CAST((RAND()*100)+156 as UNSIGNED) as B')
        ->get();


        consulta::actualizarEstados();  

        if (!$consultas->isEmpty()) {
            return view('index',['consultas'=>$consultas,'consultasD'=>$consultasD]);
        }

    
        return view('index');
        
    }

    Public function index() {
        
        return view('login.index');
    }

    Public function login(Request $request) {

        $nombre=$request->usuario;
        $contraseña=$request->password;  
        
        $usuario=User::where('nombre_usuario',$nombre)->first();
        
        if ($usuario->estado_usuario==0) {

            return redirect()->back()->withErrors(['danger' => "no puede ingresar al sistema comuniquese con el administrador"])->withInput($request->all());
        }
        
        if ($usuario) {

            

            if ($usuario['password_usuario']==md5($contraseña)) {

                Auth::login($usuario);

                if (Session::get('url')) {
                       
                    return redirect(Session::get('url'));
                } 
                
                return redirect(route('index'));
            }
                
            return redirect()->back()->withErrors(['danger' => "Contraseña incorrecta."])->withInput($request->all());

        }

        return redirect()->back()->withErrors(['danger' => "El usuario es incorrecto."])->withInput($request->all());
        
    }

    public function cerrar(){

        Auth::logout();
      
        return redirect(route('login.index'));
    }
}
