<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\consulta;
use App\Models\orden;
use App\Models\estudio;
use Illuminate\Http\Request;
use session;

class ordenController extends Controller
{
    public function insert(Request $request){

        if (!Auth::user()) {

            Session::put('url', url()->current());
            return redirect(route('login.index'));
        }

        $consulta = consulta::find($request->consulta_id);

        // Manejo exclusivo de órdenes de laboratorio
        if ($request->has('examenes_id')) {
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

        $consulta = consulta::find($id);

        // Manejo exclusivo de actualización de órdenes de laboratorio
        if ($request->has('examenes_id')) {
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

        $nombreArchivo = 'Orden de Laboratorio ' . $consulta->paciente->identificacion_paciente . '.pdf';

        $pdf = \PDF::loadView('consulta.pdfOrdenLaboratorio', [
            'consulta' => $consulta
        ])->setPaper([0, 0, 595.2756,  419.5276]);

        return $pdf->stream($nombreArchivo);
    }
}
