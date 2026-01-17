<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\examen;

class ListaEstudio extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    
    public $examenes;
    public $examenesSeleccionados;
    public $consulta;
    
    public function __construct($consulta = null)
    {
        $this->consulta = $consulta;
        $this->examenes = examen::where('estado_examen','<','2')
                                ->where('tipo_examen_id', 2) // Solo estudios (tipo_examen = 2)
                                ->get();
        
        // Si existe una consulta y tiene orden de estudios, obtener los exámenes seleccionados
        $this->examenesSeleccionados = [];
        if ($consulta && $consulta->tieneEstudio()) {
            // Buscar la orden que tiene estudios (tipo_examen_id = 2)
            $orden = \App\Models\orden::where('consulta_id', $consulta->id)
                                    ->whereHas('examenes', function($query) {
                                        $query->where('tipo_examen_id', 2);
                                    })->first();
            if ($orden) {
                $this->examenesSeleccionados = $orden->examenes->where('tipo_examen_id', 2)->pluck('id')->toArray();
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lista-estudio');
    }
}