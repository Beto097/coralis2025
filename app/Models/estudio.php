<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class estudio extends Model
{
    use HasFactory;
    protected $table = "estudio";

    protected $fillable = [
        'consulta_id',
        'tipo',
        'estudio',
        'informe_clinico'
    ];

    public function consulta()
    {
        return $this->belongsTo('App\Models\consulta');
    }
}