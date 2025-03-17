<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\sucursal;
use App\Models\rol;

class CrearUsuario extends Component
{
    /**
     * Create a new component instance.
     */
    public $sucursales;
    public $roles;
    
    public function __construct()
    {
        $this->roles = rol::where('estado_rol',1)->get();
        $this->sucursales = sucursal::where('estado_sucursal',1)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.crear-usuario');
    }
}
