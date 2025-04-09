@extends('plantilla.plantillaDT')

@section('titulo')
    Consultas
@endsection


@section('css')    

    @include('scripts.consulta')
    
@endsection

@section('contenido')
    				
    <div class="row">
        <br>
        <div class="col-sm-10">
            <p>Este listado muestra todos los consultas que estan registrados en el sistema.</p>
        </div>
        <div class="col-sm-2">
          @if(Auth::user()->accesoRuta('/consulta/create'))
            <button class="btn btn-primary btn-lable-wrap left-label" id="addNewConsulta" data-toggle="modal" data-target="#addNewConsultaModal"> 
              <span class="btn-label"><i class="fa fa-folder-o"></i> </span><span class="btn-text">
                Agregar Consulta
              </span>
            </button>
            @include('modals.ConsultaModals')  
             
          @endif

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
                        <h6 class="panel-title txt-dark">Consultas</h6>
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
                                        <th>Tiempo</th>                            
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                      </tr>
                                      
                                    </thead>
                                    
                                    <tbody>
                                      @foreach ($resultado as $key=>$fila)
                                        <tr style="font-size: 100%;">
                                          <td>{{$key+1}}</td>
                                          <td>{{$fila->paciente->identificacion_paciente}}</td>
                                          <td>{{$fila->paciente->nombre_paciente}} {{$fila->paciente->apellido_paciente}}</td>
                                          <td>@if($fila->paciente->sexo_paciente=="m")M @else F @endif</td>
                                          <td>{{\Carbon\Carbon::parse($fila->paciente->fecha_nacimiento_paciente)->age}}</td> 
                                          <td>{{\Carbon\Carbon::parse($fila->created_at)->diffForHumans()}}</td>                             
                                          <td><p>{{$fila->estado_consulta}}</p></td>
                                          <td>
                                            
                
                                            
                                            @if (Auth::user()->accesoRuta('/consulta/registrar'))                        
                                              <a class="btn btn-info btn-sm btnIcono" title="Atender Consulta" href="{{route('consulta.iniciar', ['id'=> $fila->id] )}}" class=""><i id="iconoBoton" class="fa fa-plus-square"></i></a>
                                              
                                            @endif 
                                            
                                            @if (Auth::user()->accesoRuta('/consulta/reasignar'))  
                                                  

                                                        <button type="button" title="Reasignar Consulta" class="btn btn-primary btn-sm btnIcono "                
                                                            data-toggle="modal" data-target="#reasignarConsultaDoctorModal{{$fila->id}}">
                                                            <i id="iconoBoton" class="fa fa-file"></i>
                                                        </button>
                                                        @include('modals.reasignarConsultaDoctorModals')
                                                  
                                                @endif 
                                            @if ($fila->tieneReceta() && Auth::user()->accesoRuta('/receta/imprimir'))
                                              <a class="btn btn-sm btn-warning btnIcono" title="Imprimir Receta" href="{{route('receta.print', ['id'=> $fila->id] )}}" class=""><i id="iconoBoton" class="fa fa-print"></i></a>
      
                                            @endif

                                            @if (Auth::user()->accesoRuta('/consulta/delete'))
                                                <a class="btn btn-danger btn-sm btnIcono" title="Eliminar consulta" href="https://banistmo.com" onclick="
                                                  return confirm('Desea eliminar este consulta del sistema?')"><i class="fa fa-trash-o"></i></a> 
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
                                        <th>Tiempo</th>                            
                                        <th>Estado</th>
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






