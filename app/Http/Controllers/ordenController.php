<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\consulta;
use App\Models\orden;
use Illuminate\Http\Request;
use session;

class ordenController extends Controller
{
    public function insert(Request $request){
        
        if (!Auth::user()) {

            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }
        if(true){
            $consulta = consulta::find($request->consulta_id);
            $examenes = $request->input('examenes_id', []);            

            $orden = orden::create([
                'consulta_id' => $consulta->id,
                'paciente_id' => $consulta->paciente->id,   
            ]);

            $orden->examenes()->attach($examenes);

            return redirect()->back()->withErrors(['success' => "se creo la orden de laboratorio correctamente" ]);

        }
        return redirect(route('index'));
    }

    public function update(Request $request, $id){
        
        if (!Auth::user()) {
            Session::put('url', url()->current());    
            return redirect(route('login.index'));
        }
        
        if(true){
            $orden = orden::find($id);
            $examenes = $request->input('examenes_id', []);            

            // Sincronizar exámenes (esto eliminará los anteriores y agregará los nuevos)
            $orden->examenes()->sync($examenes);

            return redirect()->back()->withErrors(['success' => "se actualizó la orden de laboratorio correctamente" ]);
        }
        
        return redirect(route('index'));
    }

    public function print($id, Request $request){
        $consulta = consulta::find($id);
        $tipo = $request->get('tipo', 'laboratorio'); // Por defecto laboratorio para compatibilidad

        $nombreArchivo = '';
        if ($tipo === 'estudio') {
            $nombreArchivo = 'Orden de Estudios '.$consulta->paciente->identificacion_paciente.'.pdf';
        } else {
            $nombreArchivo = 'Orden de Laboratorio '.$consulta->paciente->identificacion_paciente.'.pdf';
        }

        $pdf = \PDF::loadView('consulta.pdfOrden', [
            'consulta' => $consulta,
            'tipo' => $tipo
        ])->setPaper([0, 0, 595.2756,  419.5276]);

        return $pdf->stream($nombreArchivo);
    }
}
