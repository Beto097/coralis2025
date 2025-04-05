@extends('plantilla.plantillaDT')

@section('titulo')
    Pacientes
@endsection

@section('css')    
    @include('scripts.validaciones')
    @include('scripts.menorEdad')
@endsection

@section('contenido')
    				
    <div class="row">
        <br>
        <div class="col-sm-10">
            <p>Este listado muestra todos los pacientes que estan registrados en el sistema.</p>
        </div>
        <div class="col-sm-2">
            <button class="btn btn-primary btn-lable-wrap left-label" id="addNewPaciente" data-toggle="modal" data-target="#addNewPacienteModal"> <span class="btn-label"><i class="fa fa-folder-o"></i> </span><span class="btn-text">Agregar Paciente</span></button>
            @include('modals.PacienteModals')
        </div>
        <br>
        <br>
        <br>
 
        <div class="col-sm-4 col-sm-offset-8">
          @include('plantilla.errores')
        </div>
        <div class="col-sm-12">
            <div class="panel panel-default card-view">
                <div class="panel-heading">
                    <div class="pull-left">
                        <h6 class="panel-title txt-dark">Pacientes</h6>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-wrapper collapse in">
                    <div class="panel-body">
                        <div class="table-wrap">
                            <div class="table-responsive">
                                <table id="datable_1" class="table table-hover display  pb-30" cellspacing="0"  style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cédula</th>
                                            <th>Nombre</th>
                                            <th>Sexo</th>
                                            <th>Edad</th>
                                            <th>Telefono</th>
                                            <th>Email</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach ($resultado as $fila)
                                            <tr style="font-size: 90%;">
                                            <td>{{$fila->id}}</td>
                                            <td>{{$fila->identificacion_paciente}}</td>
                                            <td>{{$fila->nombre_paciente}} {{$fila->apellido_paciente}}</td>
                                            <td>@if($fila->sexo_paciente=="m")<span class="label label-primary">Masculino</span>@else<span class="label label-info">Femenino</span>@endif</td>
                                            <td>{{\Carbon\Carbon::parse($fila->fecha_nacimiento_paciente)->age}}</td>
                                            <td>{{$fila->telefono_paciente}}</td>
                                            <td><p style="font-size: 90%;">{{$fila->email_paciente}}</p></td>
                                            <td>
                                                @if (Auth::user()->accesoRuta('/consulta/create'))  
                                                  

                                                        <button type="button" title="Crear Consulta" class="@if ($fila->consultaActiva()) btn btn-warning btn-sm btnIcono disabled @else btn btn-primary btn-sm btnIcono @endif" id="crearConsulta"                
                                                            data-toggle="modal" data-target="#crearConsultaDoctorModal{{$fila->id}}" onclick="this.classList.add('disabled'); this.style.pointerEvents='none';">
                                                            <i id="iconoBoton" class="@if ($fila->consultaActiva()) fa fa-clock-o @else fa fa-file @endif"></i>
                                                        </button>
                                                        @include('modals.CrearConsultaDoctorModals')
                                                  
                                                @endif 
                                             
                                                @if (Auth::user()->accesoRuta('/paciente/historia/clinica'))

                                                    <a class="btn btn-info btn-sm btnIcono" title="ver Historial" href="{{route('paciente.verHistorial', ['id'=> $fila->id] )}}" class=""><i id="iconoBoton" class="fa fa-files-o"></i></a>

                                                @endif  
                                                @if (Auth::user()->accesoRuta('/paciente/update')) 
                                                    {{-- <a class="btn btn-success btn-sm " title="Modificar paciente" href="{{route('paciente.update', ['id'=> $fila->id] )}}" class=""><i id="iconoBoton" class="fas fa-user-edit"></i></a> --}}
                                                    <button type="button" class="btn btn-success btn-sm btnIcono " id="editPaciente"                
                                                        data-toggle="modal" data-target="#editarPacienteModal{{$fila->id}}">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    @include('modals.editarPacienteModals')
                                                @endif
                                                
                                                @if (Auth::user()->accesoRuta('/paciente/delete')) 
                                                    @if($fila->estado_paciente == 1)

                                                        <a class="btn btn-danger btn-sm btnIcono" title="Eliminar paciente" href="{{route('paciente.delete', ['id'=> $fila->id] )}}" onclick="
                                                        return confirm('Desea eliminar este paciente del sistema?')"><i class="fa fa-trash-o"></i></a>
                                                    
                                                    @else
                                                        
                                                        <a class="btn btn-warning btn-sm btnIcono" title="Desbloquear paciente" href="{{route('paciente.desbloquear', ['id'=> $fila->id] )}}" onclick="
                                                        return confirm('Desea desbloquear este paciente del sistema?')"><i class="fa fa-unlock-alt"></i></a>
                                                    
                                                    @endif 
                                                @endif
                                                
                                                
                                            </td>
                                            </tr>
                                        @endforeach
                                       
                                    </tbody>
                                
                                    <tfoot>
                                        <tr>                                                                                   
                                            <th>ID</th>
                                            <th>Cédula</th>
                                            <th>Nombre</th>
                                            <th>Sexo</th>
                                            <th>Edad</th>
                                            <th>Telefono</th>
                                            <th>Email</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
        </div>
    </div>
@endsection

@section('ordenarTabla')

    ,"order": [[0,'desc']]
     ,"columns": [
      null,
      null,
      null,
      null,
      null,
      null,
      null,
      { "width": "20%" }
    ],
    "pageLength": 15,
    lengthMenu: [15, 30, 50, 100],
    

@endsection