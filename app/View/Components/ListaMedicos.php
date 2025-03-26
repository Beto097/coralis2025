<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\rol;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ListaMedicos extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $rol;
    public $medicos;
    public function __construct()
    {
        $this->rol = rol::where('nombre_rol','Médico')->first();
        $this->medicos= User::where('rol_id',$this->rol->id)->where('sucursal_id',Auth::user()->sucursal_id)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.lista-medicos');
    }
}
