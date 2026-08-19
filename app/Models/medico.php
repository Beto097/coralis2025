<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;


class medico extends User
{
    protected $table = "usuario";

    protected static function booted()
    {
        static::addGlobalScope('medico', function (Builder $builder) {
            $builder->where('rol_id', 5);
        });
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    public function obtenerEspaciosDisponibles(string $date)
    {
        $date = Carbon::parse($date);

        $start = Carbon::parse($date->format('Y-m-d') . ' ' . $doctor->start_time);
        $end   = Carbon::parse($date->format('Y-m-d') . ' ' . $doctor->end_time);

        $slots = [];

        // Citas ya reservadas
        $existingAppointments = Agenda::where('medico_id', $this->id)
            ->whereDate('fecha_agenda', $date->toDateString())
            ->pluck('fecha_agenda')
            ->map(fn($item) => Carbon::parse($item)->format('H:i'))
            ->toArray();

        while ($start < $end) {
            $time = $start->format('H:i');

            $slots[] = [
                'time' => $time,
                'available' => !in_array($time, $existingAppointments)
            ];

            $start->addMinutes($doctor->slot_duration);
        }

        return $slots;
    }
}
