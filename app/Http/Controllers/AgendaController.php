<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medico;
use App\Models\User;
use App\Models\Agenda;
use App\Models\consulta;
use App\Models\paciente;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index(Request $request)
    {
        $usuario = auth()->user();

        // Los médicos son usuarios con rol 5 (consulta.medico_id referencia usuario.id)
        $doctors = User::where('rol_id', 5)->where('estado_usuario', 1);
        if ($usuario->rol_id == 5) {
            $doctors->where('id', $usuario->id);
        }
        $doctors = $doctors->orderBy('primer_nombre_usuario')->get();

        $paciente = null;
        if ($request->has('paciente_id')) {
            $paciente = paciente::find($request->get('paciente_id'));
        }

        return view('agenda.index', compact('doctors', 'paciente'));
    }

    public function buscarPacientes(Request $request)
    {
        $q = trim($request->input('q', ''));

        if (strlen($q) < 2) {
            return response()->json([]);
        }

        $pacientes = paciente::where('estado_paciente', 1)
            ->where(function ($query) use ($q) {
                $query->where('identificacion_paciente', 'LIKE', $q . '%')
                    ->orWhere('nombre_paciente', 'LIKE', $q . '%')
                    ->orWhere('apellido_paciente', 'LIKE', $q . '%')
                    ->orWhereRaw("CONCAT(nombre_paciente,' ',apellido_paciente) LIKE ?", [$q . '%']);
            })
            ->orderBy('nombre_paciente')
            ->take(15)
            ->get(['id', 'identificacion_paciente', 'nombre_paciente', 'apellido_paciente']);

        return response()->json($pacientes);
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
                'llego'      => '#E43E9E',
                'cancelada'  => '#F45643',
                'completada' => '#3c8dbc',
                default      => '#F8BD4B'
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
            'doctor_id' => 'required|exists:usuario,id',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);
        $paciente = paciente::where('identificacion_paciente',$request->identificacion)->first();
        if (!$paciente) {
            return response()->json(['error' => 'Paciente no encontrado'], 404);
        }

        $ocupado = Agenda::where('medico_id', $request->doctor_id)
            ->where('estado', '!=', 'cancelada')
            ->where('fecha_inicio', '<', $request->end)
            ->where('fecha_fin', '>', $request->start)
            ->exists();

        if ($ocupado) {
            $mensaje = 'El médico ya tiene una cita en ese horario.';
            if ($request->expectsJson()) {
                return response()->json(['message' => $mensaje], 422);
            }
            return redirect()->back()->withErrors(['danger' => $mensaje]);
        }

        $agenda = Agenda::create([
            'medico_id' => $request->doctor_id,
            'paciente_id' => $paciente->id,
            'fecha_inicio' => $request->start,
            'fecha_fin' => $request->end,
            'estado' => 'agendada',
            'usuario_id' => auth()->id(),
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'id' => $agenda->id]);
        }

        return redirect()->back()->with('success', 'Cita agendada correctamente.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'medico_id' => 'required|exists:usuario,id',
            'estado' => 'required|in:' . implode(',', Agenda::ESTADOS),
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->actualizarEstado($request->medico_id, $request->estado, auth()->user());

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
