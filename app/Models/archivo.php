<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class archivo extends Model
{
    use HasFactory;

    protected $table = "archivo";
    public function consulta()
    {
        return $this->belongsTo('App\Models\consulta');
    }
}
