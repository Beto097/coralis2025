<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orden extends Model
{
    use HasFactory;
    protected $table = "orden";

    protected $fillable = [
        'consulta_id',
        'paciente_id'

    ];
    public function examenes()
    {
        return $this->belongsToMany(examen::class, 'examen_orden', 'orden_id', 'examen_id')
                    ->withTimestamps();
    }
}
