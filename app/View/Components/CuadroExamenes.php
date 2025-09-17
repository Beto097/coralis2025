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
    public function __construct()
    {
        $this->examenes = examen::where('estado_examen','<','2')->get();
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
