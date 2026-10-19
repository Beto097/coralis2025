<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];


    public function medico()
    {
        return $this->belongsTo(medico::class);
    }

    public function paciente()
    {
        return $this->belongsTo(paciente::class);
    }
}
