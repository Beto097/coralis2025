<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medico;
use App\Models\Agenda;
use App\Models\paciente;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index()
    {
        $usuario = auth()->user();
        
        if($usuario->rol_id != 5){$doctors = medico::all();}else{$doctors = medico::where('id', $usuario->id)->get();}
        
        return view('agenda.index', compact('doctors'));
    }

    public function obtenerDisponibilidad(Request $request)
    {
        $request->validate([
            'metico_id' => 'required|exists:medico,id',
            'date' => 'required|date'
        ]);

        $doctor = medico::findOrFail($request->medico_id);

        $slots = $doctor->obtenerEspaciosDisponibles($request->date);

        return response()->json($slots);
    }

    public function events(Request $request)
    {
        $start = $request->start;
        $end   = $request->end;
        $medicoId = $request->doctor_id;

        $query = Agenda::with(['paciente', 'medico'])
            ->where(function ($q) use ($start, $end) {
                $q->whereBetween('fecha_inicio', [$start, $end])
                ->orWhereBetween('fecha_fin', [$start, $end])
                ->orWhere(function ($q2) use ($start, $end) {
                    $q2->where('fecha_inicio', '<=', $start)
                        ->where('fecha_fin', '>=', $end);
                });
            });

        if ($medicoId) {
            $query->where('medico_id', $medicoId);
        }

        $agendas = $query->get();

        $events = $agendas->map(function ($agenda) use ($medicoId) {

            // 🎨 Color por estado
            $color = match($agenda->estado) {
                'agendada'   => '#F8BD4B',
                'confirmada' => '#9BCB64',
                'cancelada'  => '#F45643',
                'completada' => '#3c8dbc',
                default      => '#E43E9E'
            };

            // 🧠 Lógica del título
            if ($medicoId) {
                // Solo paciente si ya está filtrado
                $title = $agenda->paciente->nombre_paciente.' '.$agenda->paciente->apellido_paciente;
            } else {
                // Mostrar paciente + doctor si no hay filtro
                $title = $agenda->paciente->nombre_paciente.' '.$agenda->paciente->apellido_paciente. ' - Dr. ' .
                        $agenda->medico->primer_nombre_usuario . ' ' .
                        $agenda->medico->apellido_usuario;
            }

            return [
                'id' => $agenda->id,
                'title' => $title,
                'start' => $agenda->fecha_inicio,
                'end' => $agenda->fecha_fin,
                'color' => $color,
                'medico_id' => $agenda->medico_id,
                'estado' => $agenda->estado,
            ];
        });

        return response()->json($events);
    }
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return response()->json([
            'message' => 'Cita eliminada correctamente'
        ]);
    }

    


    public function guardar(Request $request)
    {
       
        $request->validate([            
            'identificacion' => 'required|exists:paciente,identificacion_paciente',
            'start' => 'required',
            'end' => 'required',
        ]);
        $paciente = paciente::where('identificacion_paciente',$request->identificacion)->first();
        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }
        Agenda::create([
            'medico_id' => $request->doctor_id,
            'paciente_id' => $paciente->id  ,
            'fecha_inicio' => $request->start,
            'fecha_fin' => $request->end,
            'estado' => 'agendada'
        ]);

        return redirect()->back()->with('success', 'Cita agendada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);        
        $agenda->update([
            'medico_id' => $request->medico_id,
            'estado' => $request->estado
        ]);

        return response()->json(['success' => true]);
    }

    public function updateHorario(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $agenda->update([
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin
        ]);

        return response()->json(['success' => true]);
    }

}
