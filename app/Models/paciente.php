<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class paciente extends Model
{
    protected $table = "paciente";

    public function consultas()
    {
        return $this->hasMany('App\Models\consulta');
    }


    public function consultaActiva(){
        $exite = consulta::where('estado_consulta','Pendiente')->where('paciente_id',$this->id)->count();
        if($exite>0){
            return true;
        }

        return false;
    }

    public function edad(){

        $edad = Carbon::parse($this->fecha_nacimiento_paciente)->age;

        return $edad;
    }
}
