<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\consulta;
use App\Models\estudio;
use Illuminate\Http\Request;
use Session;

class EstudioController extends Controller
{
    public function insert(Request $request)
    {
        if (!Auth::user()) {
            Session::put('url', url()->current());
            return redirect(route('login.index'));
        }

        $consulta = consulta::find($request->consulta_id);

        // Crear estudios enviados en el request
        if ($request->has('txtEstudio')) {
            $tiposEstudio = $request->input('txtTipoEstudio', []);
            $estudios = $request->input('txtEstudio', []);
            $informesClinicos = $request->input('txtInformeClinico', []);

            foreach ($estudios as $index => $estudioNombre) {
                estudio::create([
                    'consulta_id' => $consulta->id,
                    'tipo' => $tiposEstudio[$index] ?? '',
                    'estudio' => $estudioNombre,
                    'informe_clinico' => $informesClinicos[$index] ?? ''
                ]);
            }

            return redirect()->back()->withErrors(['success' => "se creo la orden de estudios correctamente" ]);
        }

        return redirect(route('index'));
    }

    public function update(Request $request, $id)
    {
        if (!Auth::user()) {
            Session::put('url', url()->current());
            return redirect(route('login.index'));
        }

        $consulta = consulta::find($id);

        if ($request->has('txtEstudio')) {
            // Eliminar existentes y crear nuevos
            estudio::where('consulta_id', $consulta->id)->delete();

            $tiposEstudio = $request->input('txtTipoEstudio', []);
            $estudios = $request->input('txtEstudio', []);
            $informesClinicos = $request->input('txtInformeClinico', []);

            foreach ($estudios as $index => $estudioNombre) {
                estudio::create([
                    'consulta_id' => $consulta->id,
                    'tipo' => $tiposEstudio[$index] ?? '',
                    'estudio' => $estudioNombre,
                    'informe_clinico' => $informesClinicos[$index] ?? ''
                ]);
            }

            return redirect()->back()->withErrors(['success' => "se actualizó la orden de estudios correctamente" ]);
        }

        return redirect(route('index'));
    }

    public function print($id)
    {
        $consulta = consulta::find($id);
        $nombreArchivo = 'Orden de Estudios ' . $consulta->paciente->identificacion_paciente . '.pdf';

        $pdf = \PDF::loadView('consulta.pdfOrdenEstudio', [
            'consulta' => $consulta
        ])->setPaper([0, 0, 595.2756,  419.5276]);

        return $pdf->stream($nombreArchivo);
    }
}
