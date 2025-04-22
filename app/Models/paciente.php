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

        $fechaNacimiento = Carbon::parse($this->fecha_nacimiento_paciente);
        $hoy = Carbon::now();
        $diferencia = $fechaNacimiento->diff($hoy);
    
        if ($diferencia->y >= 5) {
            return $diferencia->y . ' años';
        }
    
        if ($diferencia->y >= 1) {
            return $diferencia->y . 'a ' . $diferencia->m . 'm';
        }
    
        if ($diferencia->m >= 1) {
            return $diferencia->m . 'm ' . $diferencia->d . 'd';
        }
    
        return $diferencia->d . ' días';
    }
}
