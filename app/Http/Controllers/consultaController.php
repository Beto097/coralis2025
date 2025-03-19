<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\consulta;
use App\Models\paciente;

use Session;

class consultaController extends Controller
{
    public function index(){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/consulta')){

            consulta::actualizarEstados();            

            if(Auth::user()->accesoRuta('/consulta/all')){

                

                $resultado = consulta::get();

            }elseif(Auth::user()->accesoRuta('/paciente/historia/clinica')){                
                

                $resultado = consulta::where('estado_consulta','Pendiente')->orWhere('estado_consulta','EN CURSO')->orderBy('estado_consulta','DESC')->get();

            }else{
                

                $resultado = consulta::where('estado_consulta','Pendiente')->get();

            }          

            return view('consulta.index', ["resultado"=>$resultado]);
            
        }

        return redirect(route('index'));

    }

    public function create2($id){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/consulta/create')){

            $obj_consulta = new consulta();        
            $obj_consulta->paciente_id=$id;
            $obj_consulta->estado_consulta = 'Pendiente';
            $obj_consulta->usuario_id = Auth::user()->id;
            $obj_consulta->sucursal_id = Auth::user()->sucursal_id;      
            
            $obj_consulta->save();
            return redirect()->back()->withErrors(['status' => "Se ha creado la consulta para el paciente: " .$obj_consulta->paciente->identificacion_paciente ]);
            
            
        }

        return redirect(route('index'));

    }

    public function menor(Request $request){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/consulta/create')){
                        
  
            $obj_consulta = new consulta();        
            $obj_consulta->paciente_id= $request->paciente_id;
            $obj_consulta->responsable_menor = $request->txtNombre;
            $obj_consulta->parentesco_menor = $request->txtParentesco;
            $obj_consulta->estado_consulta = 'Pendiente';        
            
            $obj_consulta->save();
            return redirect()->back()->withErrors(['status' => "Se ha creado la consulta para el paciente: " .$obj_consulta->paciente->identificacion_paciente ]);
            
        }

        return redirect(route('index'));

    }

    public function iniciar($id){


        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/consulta')){

            $consulta = consulta::find($id);
            $paciente = paciente::find($consulta->paciente->id);

            return view('consulta.iniciar',['consulta'=>$consulta,'paciente'=>$paciente]);
        }
    }

    public function save(Request $request){

        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/consulta/registrar')){               


            $consulta = consulta::find($request->txtConsultaId);
            $consulta->medico_id = Auth::user()->id;
            $consulta->fecha_consulta = $request->txtFecha;
            $consulta->frecuencia_respiratoria = $request->txtFrecR;
            $consulta->frecuencia_cardiaca = $request->txtFrecC;
            $consulta->presion_arterial = $request->txtPresA;
            $consulta->temperatura = $request->txtTemp;
            $consulta->saturacion_oxigeno = $request->txtSatO;
            $consulta->historia_clinica = $request->txtHistoriaClinica;
            $consulta->examen_fisico = $request->txtExamenFisico;
            $consulta->talla = $request->txtTalla;
            $consulta->peso = $request->txtPeso;
            $consulta->laboratorios_examenes = $request->txtLaboratoriosExamenes;
            $consulta->alergias = $request->txtAlergias;
            $consulta->medicinas = $request->txtMedicamentos;
            $consulta->diagnostico = $request->txtDiagnostico;
            $consulta->recomendaciones = $request->txtRecomendaciones;

            $consulta->estado_consulta = 'EN CURSO';
            $consulta->save();

            return redirect()->back()->withErrors(['status' => "Se ha guardo la consulta correctamente"]);

        }

        return redirect(route('index'));
    }
}
