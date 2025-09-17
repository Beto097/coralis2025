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

    public function print($id){
        $consulta = consulta::find($id);

        $pdf = \PDF::loadView('consulta.pdfOrden', [
            'consulta' => $consulta

        ])->setPaper([0, 0, 595.2756,  419.5276]);

        $nombreArchivo = 'Constancia '.$consulta->paciente->identificacion_paciente.'.pdf';
        return $pdf->stream($nombreArchivo);


    }
}
