<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\rol;
use App\Models\paciente;
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

        $rol = Auth::user()->rol->id;


        if($rol >0){

        $nuevospacientes = paciente::where('created_at','>',Carbon::today()->subMonth(1)->toDateString())->count();
        $ordenes_totales_mes = orden_laboratorio::where('estado_orden_laboratorio','<>','Eliminado')
                        ->where('fecha_orden','>',Carbon::today()->subMonth(1)->toDateString())
                        ->count();
        $examenes_totales_mes = examen_orden_laboratorio::where('padre','<',1)
                        ->where('created_at','>',Carbon::today()->subMonth(1)->toDateString())
                        ->count();
        $total_pacientes = paciente::where('estado_paciente',1)->count();



        $examenes = orden_laboratorio::where('estado_orden_laboratorio','<>','Eliminado')
                ->where('fecha_orden','>',Carbon::today()->subMonth(1)->toDateString())
                ->groupBy('medico_id')
                ->selectRaw('count(*) as total, medico_id,CAST((RAND()*100)+156 as UNSIGNED) as A,CAST((RAND()*100)+156 as UNSIGNED) as B')
                ->get();

        return view('index',[   'nuevos_pacientes'=>$nuevospacientes,
            'ordenes_totales_mes'=>$ordenes_totales_mes,
            'examenes_totales_mes' => $examenes_totales_mes,
            'total_pacientes' => $total_pacientes,
            'examenes' => $examenes
        ]);
        $ordenes_totales = orden_laboratorio::where('estado_orden_laboratorio','<>','Eliminado')
                        ->where('fecha_orden',Carbon::today()->toDateString())
                        ->count();
        $ordenes_totales_mes = orden_laboratorio::where('estado_orden_laboratorio','<>','Eliminado')
                        ->where('fecha_orden','>',Carbon::today()->subWeek(4)->toDateString())
                        ->count();

        $ordenes_terminadas_mes = orden_laboratorio::where('estado_orden_laboratorio','Terminado')
                        ->where('fecha_orden','>',Carbon::today()->subWeek(4)->toDateString())
                        ->count();
        $porcentaje_terminado_mes = ($ordenes_terminadas_mes/$ordenes_totales_mes)*100;
        $ordenes_enproceso_mes = orden_laboratorio::where('estado_orden_laboratorio','En Proceso')
                            ->where('fecha_orden','>',Carbon::today()->subWeek(4)->toDateString())
                            ->count();
        $porcentaje_enproceso_mes = ($ordenes_enproceso_mes/$ordenes_totales_mes)*100;
        $ordenes_pendientes_mes = orden_laboratorio::where('estado_orden_laboratorio','Pendiente')
                            ->where('fecha_orden','>',Carbon::today()->subWeek(4)->toDateString())
                            ->count();
        $porcentaje_pendiente_mes = ($ordenes_pendientes_mes/$ordenes_totales_mes)*100;

        if($ordenes_totales==0){
        return view("dashboard.index",["ordenes_totales"=>0,
                    "ordenes_terminadas"=>0,
                    "porcentaje_terminado"=>100,
                    "ordenes_enproceso"=>0,
                    "porcentaje_enproceso"=>100,
                    "ordenes_pendientes"=>0,
                    "porcentaje_pendiente"=>100,
                    "ordenes_totales_mes"=>$ordenes_totales_mes,
                    "ordenes_terminadas_mes"=>$ordenes_terminadas_mes,
                    "porcentaje_terminado_mes"=>$porcentaje_terminado_mes,
                    "ordenes_enproceso_mes"=>$ordenes_enproceso_mes,
                    "porcentaje_enproceso_mes"=>$porcentaje_enproceso_mes,
                    "ordenes_pendientes_mes"=>$ordenes_pendientes_mes,
                    "porcentaje_pendiente_mes"=>$porcentaje_pendiente_mes]);
        }
        $ordenes_terminadas = orden_laboratorio::where('estado_orden_laboratorio','Terminado')
                            ->where('fecha_orden',Carbon::today()->toDateString())
                            ->count();
        $porcentaje_terminado = ($ordenes_terminadas/$ordenes_totales)*100;
        $ordenes_enproceso = orden_laboratorio::where('estado_orden_laboratorio','En Proceso')
                            ->where('fecha_orden',Carbon::today()->toDateString())
                            ->count();
        $porcentaje_enproceso = ($ordenes_enproceso/$ordenes_totales)*100;
        $ordenes_pendientes = orden_laboratorio::where('estado_orden_laboratorio','Pendiente')
                            ->where('fecha_orden',Carbon::today()->toDateString())
                            ->count();
        $porcentaje_pendiente = ($ordenes_pendientes/$ordenes_totales)*100;


        return view("dashboard.index",["ordenes_totales"=>$ordenes_totales,
                    "ordenes_terminadas"=>$ordenes_terminadas,
                    "porcentaje_terminado"=>$porcentaje_terminado,
                    "ordenes_enproceso"=>$ordenes_enproceso,
                    "porcentaje_enproceso"=>$porcentaje_enproceso,
                    "ordenes_pendientes"=>$ordenes_pendientes,
                    "porcentaje_pendiente"=>$porcentaje_pendiente,
                    "ordenes_totales_mes"=>$ordenes_totales_mes,
                    "ordenes_terminadas_mes"=>$ordenes_terminadas_mes,
                    "porcentaje_terminado_mes"=>$porcentaje_terminado_mes,
                    "ordenes_enproceso_mes"=>$ordenes_enproceso_mes,
                    "porcentaje_enproceso_mes"=>$porcentaje_enproceso_mes,
                    "ordenes_pendientes_mes"=>$ordenes_pendientes_mes,
                    "porcentaje_pendiente_mes"=>$porcentaje_pendiente_mes]);
        }

        return view('index');
    }

    Public function index() {
        
        return view('login.index');
    }

    Public function login(Request $request) {

        $nombre=$request->usuario;
        $contraseña=$request->password;        
        
        $existe=User::where('nombre_usuario',$nombre)->count();
        
        if ($existe==1) {

            $usuario=User::where('nombre_usuario',$nombre)->first(); 

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
