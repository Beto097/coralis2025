@extends('plantilla.plantillaDT')
@section('titulo')
    Consulta
@endsection

@section('css')    

    @include('scripts.agregar')
    
@endsection

@section('contenido')

  <div class="row">
    <br>
    <br>
    <br>

    <div class="col-sm-4 col-sm-offset-8">
          @include('plantilla.errores')
        </div>
 
    <div class="col-sm-12">
        <div class="panel panel-default card-view">
            <div class="panel-heading">
                <div>
                  <div class="row">
                    <div class="col-sm-8">
                      <h6 class="panel-title txt-dark">{{$paciente->nombre_paciente}} {{$paciente->apellido_paciente}}</h6>   
                    </div>
                    
                      @isset($consulta)
                        <div class="col-sm-4 text-end">
                          @if ($consulta->estado_consulta == 'EN CURSO' || ($consulta->estado_consulta == 'TERMINADO' && $consulta->created_at>\Carbon\Carbon::now()->subHours(24)))
                            <button  title="Crear Receta"  class="btn @if ($consulta->tieneReceta()) btn-success @else btn-primary @endif" id="addNewReceta" data-toggle="modal" data-target="#addNewRecetaModal"> 
                              
                              <i class="fa fa-plus-square"></i>
                              
                            </button>
                            @if ($consulta->tieneReceta())
                              @include('modals.editarRecetaModals')
                              
                            @else
                              @include('modals.RecetaModals') 
                            @endif
                            @if (!$consulta->tieneReferencia())
                              <button class="btn  btn-danger" id="addNewReferencia" title="Crear Referencia" data-toggle="modal" data-target="#addNewReferenciaModal">
                                <i class="fa fa-ambulance" aria-hidden="true"></i>
                              </button>
                              @include('modals.ReferenciaModals')                            
                            @endif 
                            @if (!$consulta->tieneConstancia())
                              <button class="btn  btn-warning" id="addNewConstancia" title="Crear Constancia" data-toggle="modal" data-target="#addNewConstanciaModal">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                              </button>
                              @include('modals.ConstanciaModals')
                            
                            @endif   
                            
                                                         
                              
                          @endif
                          @if (Auth::user()->accesoRuta('/archivo/insertar'))
                            <button class="btn  btn-success" id="addNewFile" title="Cargar Archivo" data-toggle="modal" data-target="#addNewFileModal">
                              <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                            </button>
                            @include('modals.FileModals2')
                          
                          @endif
                          
                          <!--<a class="btn btn-info btnIcono" title="Imprimir Certificado"  target="_blank" href="{{route('certificado.print', ['id'=> $consulta->id] )}}" class=""><i class="fa fa-wpforms"></i></a>-->
                          @if (!$consulta->tieneCertificado())
                            <button class="btn btn-info btnIcono" id="addNewCertificado" title="Crear Certificado" data-toggle="modal" data-target="#addNewCertificadoModal">
                              <i class="fa fa-wpforms" aria-hidden="true"></i>
                            </button>
                            @include('modals.CertificadoModals')                          
                            
                          @endif
                          @if ($consulta->tieneImprimir())
                            <button class="btn  btn-warning" id="addImprimir" title="Imprimir Documentos" data-toggle="modal" data-target="#imprimirModal">
                              <i class="fa fa-print" aria-hidden="true"></i>
                            </button>
                            @include('modals.ImprimirModals2')
                          @endif
                        
                          @if ($consulta->estado_consulta != 'TERMINADA')
                            <button class="btn btn-primary" id="addNewRegistro" title="Registrar Consulta" data-toggle="modal" data-target="#addNewRegistroModal">                              
                              <i class="fa fa-file-text" aria-hidden="true"></i>
                            </button>
                            @include('modals.RegistroModals')  
                          @endif
                        </div>
                      @endisset
                    
                  </div>
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                  <div class="row">
                    <div class="col-md-3">
                      <ul class="list-unstyled mb-0">
                        <li class="" style="font-size: 130%"><i class="zmdi zmdi-card me-2 text-success font-size-18"></i>
                          <b>
                        Cédula</b> : {{$paciente->identificacion_paciente}}</li>
                        <li class="" style="font-size: 130%"><i class="zmdi zmdi-account me-2 text-success font-size-18"></i> <b>
                          Nombre</b> : {{$paciente->nombre_paciente}} {{$paciente->apellido_paciente}} </li>
                        <li class="" style="font-size: 130%"><i class="zmdi zmdi-male-female me-2 text-success font-size-18"></i> <b>
                                Sexo </b> : @if ($paciente->sexo_paciente=='m')
                                    Masculino
                                @else
                                    Femenino
                                @endif</li>
                        <li class="" style="font-size: 130%"><i
                                class="zmdi zmdi-cake text-success font-size-18 mt-2 me-2"></i>
                            <b> Edad </b> : {{$paciente->edad()}}
                        </li>
                        <li class="" style="font-size: 130%"><i class="zmdi zmdi-phone-end me-2 text-success font-size-18"></i> <b>
                          Telefono</b> : {{$paciente->telefono_paciente}}</li>
                        @if (\Carbon\Carbon::parse($paciente->fecha_nacimiento_paciente)->age>18)
                          <li class="" style="font-size: 130%"><i class="zmdi zmdi-male-female me-2 text-success font-size-18"></i> <b>
                              Estado Civil</b> : {{$paciente->estado_civil_paciente}}</li>
                          <li class="" style="font-size: 130%"><i
                                class="zmdi zmdi-city-alt text-success font-size-18 mt-2 me-2"></i>
                            <b>Lugar de Trabajo</b> : {{$paciente->lugar_trabajo}}
                          </li>
                        @endif
                        <li class="" style="font-size: 130%"><i
                                class="zmdi zmdi-google-maps text-success font-size-18 mt-2 me-2"></i>
                            <b>Direccion</b> : {{$paciente->direccion_paciente}}
                        </li>
                        @if (\Carbon\Carbon::parse($paciente->fecha_nacimiento_paciente)->age<18)
                                      <li class="" style="font-size: 130%"><i><
                                        class="zmdi zmdi-accounts-alt text-success font-size-18 mt-2 me-2"></i>
                                    <b>Responsable</b> : {{$consulta->responsable_menor}}
                                </li>
                                <li class="" style="font-size: 130%"><i
                                  class="zmdi zmdi-accounts-alt text-success font-size-18 mt-2 me-2"></i>
                              <b>Parentesco</b> : {{$consulta->parentesco_menor}}
                          </li>
                        @endif
                        
                      </ul>
                      <div class="row" style="margin-top: 30px;">
                        @if (Auth::user()->accesoRuta('/archivo/ver'))
                          <div class="col-md-6 col-md-offset-3">
                            <button class="btn btn-lg btn-primary text-center" id="verArchivos" title="Crear Referencia" data-toggle="modal" data-target="#verArchivosModal">
                              Ver Archivos</i>
                            </button>
                            @include('modals.verArchivosModals')     
                          </div>
                        @endif
                        
                      </div>  
                    </div>
                    <div class="col-md-9">
                      <div class="table-wrap">
                        <div class="table-responsive">
                            <table id="datable_1" class="table table-hover display  pb-30" cellspacing="0"  style="width:100%">
                                <thead>
                                  <tr>
                                    <th>ID</th>                    
                                    <th>Fecha</th>      
                                    <th>Estado</th>              
                                    <th>Diagnóstico</th>
                                    <th>Medico</th> 
                                    <th>Acciones</th>
                                  </tr>
                                </thead>
                                
                                <tbody>
                                  @foreach ($paciente->consultas as $key=>$fila)
                                    @if ($fila->estado_consulta !='CANCELADA' && $fila->estado_consulta !='ELIMINADA')
                                    <tr style="font-size: 100%;">
                                      <td>{{$key+1}}</td>
                                      <td>{{\Carbon\Carbon::parse($fila->fecha_consulta)->format('Y-m-d h:m')}}</td>
                                      <td>{{$fila->estado_consulta}}</td>
                                      <td>{{$fila->diagnostico}}</td>   
                                      <td>{{$fila->doctor->nombre_usuario}}</td>                 
                                      <td>
                                                                             
                                        @if ($fila->tieneImprimir())
                                          <button class="btn  btn-warning" id="addImprimir" title="Imprimir Documentos" data-toggle="modal" data-target="#imprimirModal{{$fila->id}}">
                                            <i class="fa fa-print" aria-hidden="true"></i>
                                          </button>
                                          @include('modals.ImprimirModals')
                                        @endif
                                        
                                        @if ($fila->created_at->addHours(24)>\Carbon\Carbon::now() && Auth::user()->accesoRuta('/consulta/registrar') )
                                          
                                          <button type="button" class="btn btn-success waves-effect waves-light"
                                              data-toggle="modal" data-animation="bounce" title="Editar Consulta"
                                              data-target="#editarRegistro2Modal{{$fila->id}}">
                                            
                                              <i class="fa fa-edit"></i>
                                          </button>
                                          @include('modals.editarRegistroModals2')
                                        @endif
                                        
                                        @if ($fila->created_at->addHours(24)<\Carbon\Carbon::now() && Auth::user()->accesoRuta('/paciente/historia/clinica'))
                                                                
                                          <button type="button" class="btn btn-primary waves-effect waves-light"
                                            data-toggle="modal" data-animation="bounce"
                                            data-target="#editarRegistroModal{{$fila->id}}">
                                          
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
                                        --}}
                                      </td>
                                    </tr>
                                    @endif
                                  
                                  @endforeach
                                  
                                </tbody>
                            
                                <tfoot>
                                  <tr>
                                    <th>ID</th>                    
                                    <th>Fecha</th>      
                                    <th>Estado</th>              
                                    <th>Diagnóstico</th>
                                    <th>Medico</th> 
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
    </div>
  </div>

@endsection
@section('script')
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const form = document.getElementById('formCrearConstancia');

      form.addEventListener('submit', function (e) {
          e.preventDefault();

          const formData = new FormData(form);

          fetch(form.action, {
              method: 'POST',
              headers: {
                  'X-CSRF-TOKEN': document.querySelector('[name=_token]').value
              },
              body: formData
          })
          .then(response => response.json())
          .then(data => {
              if (data.success && data.pdf_url) {
                  $('#addNewConstanciaModal').modal('hide');
                  window.open(data.pdf_url, '_blank');
              } else {
                  alert('Error al generar constancia');
              }
          })
          .catch(error => {
              console.error(error);
              alert('Error inesperado');
          });
      });
  });
</script>
<script>
  $('#datable_2').DataTable( {
    lengthChange: false,
    "language": {
      
      "processing": "Procesando...",
      "lengthMenu": "Mostrar _MENU_ Registros",
      "zeroRecords": "No se encontraron resultados",
      "emptyTable": "Ningún dato disponible en esta tabla",
      "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
      "infoFiltered": "(filtrado de un total de _MAX_ registros)",
      "search": "Buscar:",
      "infoThousands": ",",
      "loadingRecords": "Cargando...",
      "paginate": {
        "first": "Primero",
        "last": "Último",
        "next": ">>",
        "previous": "<<"
      },
      "aria": {
        "sortAscending": ": Activar para ordenar la columna de manera ascendente",
        "sortDescending": ": Activar para ordenar la columna de manera descendente"
      },
      "buttons": {
        "copy": "Copiar",
        "colvis": "Visibilidad",
        "collection": "Colección",
        "colvisRestore": "Restaurar visibilidad",
        "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
        "copySuccess": {
          "1": "Copiada 1 fila al portapapeles",
          "_": "Copiadas %d fila al portapapeles"
        },
        "copyTitle": "Copiar al portapapeles",
        "csv": "CSV",
        "excel": "Excel",
        "pageLength": {
          "-1": "Mostrar todas las filas",
          "1": "Mostrar 1 fila",
          "_": "Mostrar %d filas"
        },
        "pdf": "PDF",
        "print": "Imprimir"
      },
      "autoFill": {
        "cancel": "Cancelar",
        "fill": "Rellene todas las celdas con <i>%d<\/i>",
        "fillHorizontal": "Rellenar celdas horizontalmente",
        "fillVertical": "Rellenar celdas verticalmentemente"
      },
      "decimal": ",",
      "searchBuilder": {
        "add": "Añadir condición",
        "button": {
          "0": "Constructor de búsqueda",
          "_": "Constructor de búsqueda (%d)"
        },
        "clearAll": "Borrar todo",
        "condition": "Condición",
        "conditions": {
          "date": {
            "after": "Despues",
            "before": "Antes",
            "between": "Entre",
            "empty": "Vacío",
            "equals": "Igual a",
            "not": "No",
            "notBetween": "No entre",
            "notEmpty": "No Vacio"
          },
          "moment": {
            "after": "Despues",
            "before": "Antes",
            "between": "Entre",
            "empty": "Vacío",
            "equals": "Igual a",
            "not": "No",
            "notBetween": "No entre",
            "notEmpty": "No vacio"
          },
          "number": {
            "between": "Entre",
            "empty": "Vacio",
            "equals": "Igual a",
            "gt": "Mayor a",
            "gte": "Mayor o igual a",
            "lt": "Menor que",
            "lte": "Menor o igual que",
            "not": "No",
            "notBetween": "No entre",
            "notEmpty": "No vacío"
          },
          "string": {
            "contains": "Contiene",
            "empty": "Vacío",
            "endsWith": "Termina en",
            "equals": "Igual a",
            "not": "No",
            "notEmpty": "No Vacio",
            "startsWith": "Empieza con"
          }
        },
        "data": "Data",
        "deleteTitle": "Eliminar regla de filtrado",
        "leftTitle": "Criterios anulados",
        "logicAnd": "Y",
        "logicOr": "O",
        "rightTitle": "Criterios de sangría",
        "title": {
          "0": "Constructor de búsqueda",
          "_": "Constructor de búsqueda (%d)"
        },
        "value": "Valor"
      },
      "searchPanes": {
        "clearMessage": "Borrar todo",
        "collapse": {
          "0": "Paneles de búsqueda",
          "_": "Paneles de búsqueda (%d)"
        },
        "count": "{total}",
        "countFiltered": "{shown} ({total})",
        "emptyPanes": "Sin paneles de búsqueda",
        "loadMessage": "Cargando paneles de búsqueda",
        "title": "Filtros Activos - %d"
      },
      "select": {
        "1": "%d fila seleccionada",
        "_": "%d filas seleccionadas",
        "cells": {
          "1": "1 celda seleccionada",
          "_": "$d celdas seleccionadas"
        },
        "columns": {
          "1": "1 columna seleccionada",
          "_": "%d columnas seleccionadas"
        }
      },
      "thousands": "."
    
    }
    
  } );


</script>
@endsection




