<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Agenda extends Model
{
    use HasFactory;
    protected $table = "agenda";
    protected $fillable = [
        'medico_id',
        'paciente_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'consulta_id',
        'usuario_id',
    ];

    public const ESTADO_LLEGO = 'llego';

    public const ESTADOS = ['agendada', 'confirmada', 'llego', 'completada', 'cancelada'];

    // La consulta nace solo al pasar a "llego" y una única vez por cita
    public function actualizarEstado($medicoId, $estado, $usuario)
    {
        DB::transaction(function () use ($medicoId, $estado, $usuario) {
            $agenda = self::lockForUpdate()->findOrFail($this->id);

            $agenda->medico_id = $medicoId;
            $agenda->estado = $estado;

            if ($estado === self::ESTADO_LLEGO && !$agenda->consulta_id) {
                $consulta = new consulta();
                $consulta->paciente_id = $agenda->paciente_id;
                $consulta->medico_id = $agenda->medico_id;
                $consulta->usuario_id = $usuario->id;
                $consulta->sucursal_id = $usuario->sucursal_id;
                $consulta->estado_consulta = 'Pendiente';
                $consulta->motivo_consulta = 'Cita agendada';
                $consulta->save();

                $agenda->consulta_id = $consulta->id;
            }

            $agenda->save();
        });
    }


    public function medico()
    {
        return $this->belongsTo(User::class, 'medico_id');
    }

    public function paciente()
    {
        return $this->belongsTo(paciente::class);
    }
}
