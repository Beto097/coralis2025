@extends('plantilla.plantilla')
@section('titulo')
    Consulta
@endsection



@section('contenido')
<br>
<br>

<!--muestro el error-->
@include('plantilla.errores')
<!-- fin del error-->
<div class="col-sm-12">
  <div class="panel panel-default card-view">
      <div class="panel-heading">
          <div class="pull-left">
              <h6 class="panel-title txt-dark">{{$paciente->nombre_paciente}} {{$paciente->apellido_paciente}} </h6>
          </div>
          <div class="clearfix"></div>
      </div>
      <div class="panel-wrapper collapse in">
          <div class="panel-body">
            <div class="col-3">
              <div class="card">
                  <div class="card-body">
                      <h3 class="card-title mb-3 text-center"></h3>
                      <ul class="list-unstyled mb-0">
                          <li class="" style="font-size: 130%"><i class="mdi mdi-card-account-details me-2 text-success font-size-18"></i> <b>
                          Cédula</b> : {{$paciente->identificacion_paciente}}</li>
                          <li class="" style="font-size: 130%"><i class="mdi mdi-account me-2 text-success font-size-18"></i> <b>
                            Nombre</b> : {{$paciente->nombre_paciente}} {{$paciente->apellido_paciente}} </li>
                          <li class="" style="font-size: 130%"><i class="mdi mdi-gender-male-female me-2 text-success font-size-18"></i> <b>
                                  Sexo </b> : @if ($paciente->sexo_paciente=='m')
                                      Masculino
                                  @else
                                      Femenino
                                  @endif</li>
                          <li class="" style="font-size: 130%"><i
                                  class="mdi mdi-cake-variant text-success font-size-18 mt-2 me-2"></i>
                              <b> Edad </b> : {{\Carbon\Carbon::parse($paciente->fecha_nacimiento_paciente)->age}}
                          </li>
                          <li class="" style="font-size: 130%"><i class="mdi mdi-phone me-2 text-success font-size-18"></i> <b>
                            Telefono</b> : {{$paciente->telefono_paciente}}</li>
                          <li class="" style="font-size: 130%"><i class="mdi mdi-human-male-female me-2 text-success font-size-18"></i> <b>
                              Estado Civil</b> : {{$paciente->estado_civil_paciente}}</li>
                          <li class="" style="font-size: 130%"><i
                                class="mdi mdi-city text-success font-size-18 mt-2 me-2"></i>
                            <b>Lugar de Trabajo</b> : {{$paciente->lugar_trabajo}}
                        </li>
                          <li class="" style="font-size: 130%"><i
                                  class="mdi mdi-map-marker text-success font-size-18 mt-2 me-2"></i>
                              <b>Direccion</b> : {{$paciente->direccion_paciente}}
                          </li>
                          @if (\Carbon\Carbon::parse($paciente->fecha_nacimiento_paciente)->age<18)
                                        <li class="" style="font-size: 130%"><i
                                          class="mdi mdi-account-multiple text-success font-size-18 mt-2 me-2"></i>
                                      {{-- <b>Responsable</b> : {{$consulta->responsable_menor}} --}}
                                  </li>
                                  <li class="" style="font-size: 130%"><i
                                    class="mdi mdi-account-multiple text-success font-size-18 mt-2 me-2"></i>
                                <b>Parentesco</b> : {{$consulta->parentesco_menor}}
                            </li>
                          @endif
                          
                      </ul>
                  </div>
                </div>  
              </div>
          </div>
          </div>
      </div>
  </div>	
</div>
<div class="row">
    <div class="col-md-3">     
  
              
                
  
               
  
                
                
    </div>
  
    <div class="col-md-9">
      <div class="row" style="padding: 1rem;">
        <div class="col-md-10">
  
        </div>
        <div class="col-md-2">
  
          @isset($consulta)
            @if ($consulta->estado_consulta != 'TERMINADA')
              <button type="button" class="btn btn-primary waves-effect waves-light"
                data-bs-toggle="modal" data-animation="bounce"
                data-bs-target=".addNewRegistroModal">
                Llenar Historial
              </button>
              @include('modals.RegistroModals')  
            @endif
              
          @endisset
          
            
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTable" class="table table-bordered">
                <thead>
                    <tr>
                      <th>ID</th>                    
                      <th>Fecha</th>                    
                      <th>Diagnistico</th>
                      <th>Medico</th> 
                      <th>Acciones</th>
                    </tr>
                </thead>
  
  
                <tbody>
                  @foreach ($paciente->consultas as $key=>$fila)
                    @if ($fila->estado_consulta =='TERMINADA' )
                    <tr style="font-size: 100%;">
                      <td>{{$key+1}}</td>
                      <td>{{\Carbon\Carbon::parse($fila->fecha_consulta)->format('Y-m-d')}}</td>
                      <td>{{$fila->diagnostico}}</td>   
                      <td>{{$fila->nombre_medico}}</td>                 
                      <td>
                        
                        @if (Auth::user()->accesoRuta('/paciente/historia/clinica'))
                                                
                          <button type="button" class="btn btn-primary waves-effect waves-light"
                            data-bs-toggle="modal" data-animation="bounce"
                            data-bs-target=".editarRegistroModal{{$fila->id}}">
                            Ver Historia
                          </button>
                          @include('modals.editarRegistroModals')  
                            
                        @endif
                        {{--
                        
                        @if (Auth::user()->accesoRuta('/paciente/consulta'))                        
                          <a class="btn btn-info btn-sm btnIcono" title="Atender Consulta" href="{{route('consulta.create', ['id'=> $fila->id] )}}" class=""><i id="iconoBoton" class="fas fa-file-medical"></i></a>
                          
                        @endif  
  
                        {{-- @if (Auth::user()->accesoRuta('/consulta/update'))
                          <button type="button" class="btn btn-success btn-sm"
                            data-bs-toggle="modal" data-animation="bounce"
                            data-bs-target=".editarConsultaModal{{$fila->id}}">
                            <i id="iconoBoton" class="fas fa-user-edit"></i>
                          </button>  
                          @include('modals.editarConsultaModals')
                        @endif
  
                        @if (Auth::user()->accesoRuta('/consulta/delete'))
                          @if($fila->estado_consulta == 1)
  
                            <a class="btn btn-danger btn-sm btnIcono" title="Eliminar consulta" href="{{route('consulta.delete', ['id'=> $fila->id] )}}" onclick="
                              return confirm('Desea eliminar este consulta del sistema?')"><i id="iconoBoton" class="fas fa-user-times"></i></a>
                          
                          @else
                            
                            <a class="btn btn-warning btn-sm btnIcono" title="Desbloquear consulta" href="{{route('consulta.desbloquear', ['id'=> $fila->id] )}}" onclick="
                              return confirm('Desea desbloquear este consulta del sistema?')"><i id="iconoBotonW" class="fas fa-user-shield"></i></a>
                          
                          @endif 
                        
                        @endif 
                        
                      </td>--}}
                    </tr>
                    @endif
                    
                  @endforeach
  
                </tbody> 
            </table>
          </div>
        </div>
      </div>
    </div>
        
    <!-- end col -->
  </div>

@endsection
