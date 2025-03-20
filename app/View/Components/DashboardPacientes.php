<?php

namespace App\View\Components;

use Illuminate\View\Component;

use App\Models\consulta;
use App\Models\paciente;

use Carbon\Carbon;

class DashboardPacientes extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $nuevos_pacientes;
    public $consultas_totales;
    public $consultas_mes;
    public $total_pacientes;

    
    public function __construct()
    {
        $this->nuevos_pacientes = paciente::where('created_at','>',Carbon::today()->subMonth(1)->toDateString())->count();
        $this->total_pacientes = paciente::where('estado_paciente',1)->count();
        $this->consultas_mes = consulta::where('estado_consulta','TERMINADA')->where('fecha_consulta','>',Carbon::today()->subMonth(1)->toDateString())->count();
        $this->consultas_totales = consulta::where('estado_consulta','TERMINADA')->count();


    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard-pacientes');
    }
}
