<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\examen;

class CuadroExamenes extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    
    public $examenes;
    public $examenesSeleccionados;
    public $tipoExamen;
    
    public function __construct($consulta = null, $tipoExamen = 1)
    {
        $this->tipoExamen = $tipoExamen;
        $this->examenes = examen::where('estado_examen','<','2')
                                ->where('tipo_examen_id', $tipoExamen)
                                ->get();
        
        // Si existe una consulta y tiene orden, obtener los exámenes seleccionados
        $this->examenesSeleccionados = [];
        if ($consulta && $consulta->tieneOrden()) {
            $orden = $consulta->orden();
            $this->examenesSeleccionados = $orden->examenes->pluck('id')->toArray();
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cuadro-examenes');
    }
}
