<?php

namespace App\View\Components;

use Illuminate\View\Component;

class EditarRecetaMedica extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $consulta;
    public $tipo;

    public function __construct($resultado , $modo = 'normal')
    {
        $this->consulta =$resultado;
        if($modo == 'imprimir'){
            $this->tipo = $modo;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.editar-receta-medica');
    }
}
