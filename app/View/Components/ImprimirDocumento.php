<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ImprimirDocumento extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $consulta;
    public $resultado;
    
    public function __construct($resultado = null)
    {
        $this->resultado = $resultado;
        $this->consulta = $resultado;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.imprimir-documento');
    }
}
