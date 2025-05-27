<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

use App\Models\consulta;
use App\Models\constancia;

use Illuminate\Http\Request;

use Session;

class constanciaController extends Controller
{
    public function insert(Request $request){    
    
        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }
        
        if(Auth::user()->accesoRuta('/constancia/create')){
                       
            

            $constancia = constancia::where('consulta_id', $request->txtId)->first();

            if (!$constancia) {
                $constancia = new constancia();
            }

            $constancia->consulta_id = $request->txtId;
            $constancia->hora_inicio = $request->hora_inicio;
            $constancia->hora_fin = $request->hora_fin;
            $constancia->fecha = $request->fecha_constancia;
            $constancia->save();
 
            
            return redirect()->back()->withErrors(['status' => "Se creo la constancia correctamente." ]);  
        }
        
              
        return redirect()->back()->withErrors(['danger' => "No tienes acceso a esta funcion." ]);            
        
        
    }

    public function print($id){
        
        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }

        if(Auth::user()->accesoRuta('/constancia/imprimir')){

            $consulta = consulta::find($id);
            
            $constancia = constancia::where('consulta_id', $id)->first();
            
            $firmaPath = public_path("img/firmas/{$consulta->doctor->nombre_usuario}.PNG");
            $selloPath = public_path("img/sellos/{$consulta->doctor->nombre_usuario}.PNG");

            
            $firmaExiste = File::exists($firmaPath);
            $selloExiste = File::exists($selloPath);

            $pdf = \PDF::loadView('consulta.constanciaPdf', [
                'consulta' => $consulta,
                'constancia' => $constancia,
                'firma' => $firmaExiste,
                'sello' => $selloExiste
            ])->setPaper([0, 0, 595.2756,  419.5276]);

            $nombreArchivo = 'Constancia '.$consulta->paciente->identificacion_paciente.'.pdf';
            return $pdf->stream($nombreArchivo);
            

            
            
        }

        return redirect()->back()->withErrors(['danger' => "No tienes acceso a esta funcion." ]);

        


    }
}
