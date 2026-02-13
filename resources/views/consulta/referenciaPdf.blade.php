<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
   <style>
    @page {
      size: 22in 17in; /* Letter exacto: 8.5x11 pulgadas */
      margin: 0;
    }

    #nRegistro{
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size:20px;
        color: red;
    }

    #fila{
        font-family: Arial, Helvetica, sans-serif;        
        font-size:20px;
        color: black;
    }

    body {
      margin: 0;
      padding: 0;      
      background-image: url('{{ public_path('img/ReferenciaV2.1.png') }}'); 
      background-size: 22in 17in; /* Tamaño exacto sin escalado */
      background-repeat: no-repeat;
      background-position: 0 0; /* Posición exacta sin centrar */
      image-rendering: auto;
    }

    .pagina {
      width: 22in;
      height: 17in;
      box-sizing: border-box;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: sans-serif;
    }
  </style>
  <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    
        <div class="pagina">

            <div id='fila'  style="position: absolute; top: 230px; left: 500px;">
                <span style="position: absolute; width: 300px;  ">Clinica Coralis</span>
                <span style="position: absolute; left: 400px; width: 300px;">{{$consulta->referencia->datos['RefiereA']}}</span>
            </div>  
               
            <div id='fila'  style="position: relative; left: 80px; top: 265px;">
                <span style="position: relative; left: -25px; ">{{ $fecha['dia'] }}</span>
                <span style="position: relative; ">{{ $fecha['mes'] }}</span>
                <span style="position: relative; left: 35px;">{{ $fecha['anio'] }}</span>
                <span style="position: relative; left: 80px;">{{ $fecha['hora'] }}</span>
                <span style="position: relative; left: 110px;">{{ $fecha['minuto'] }}</span>
            </div>             
            <div id='fila'  style="position: relative; left: @if($consulta->referencia->datos['tipoR']==1) 608px @else 860px @endif; top: 275px; height: 30px;">
                <span style="position: relative; width: 300px;  ">X</span>
                
            </div>  
            
            <div id="fila" style="position: relative; margin-top: 390px; padding-left: 100px; height: 30px;">
                <span style="position: absolute; left: 100px; top: 0;">{{$consulta->paciente->nombres(1)}}</span>
                <span style="position: absolute; left: 430px; top: 0;">{{$consulta->paciente->nombres(2)}}</span>
                <span style="position: absolute; left: 700px; top: 0;">{{$consulta->paciente->apellidos(1)}}</span>
                <span style="position: absolute; left: 980px; top: 0;">{{$consulta->paciente->apellidos(2)}}</span>
            </div> 
            
            <div id="fila" style="position: relative; margin-top: 45px; padding-left: 120px; height: 30px;">
                <span style="position: absolute; left: 110px; top: 0;">{{$consulta->paciente->telefono_paciente}}</span>
                <span style="position: absolute; left: 435px; top: 0;">{{$consulta->paciente->identificacion_paciente}}</span>
                <span style="position: absolute; left: 700px; top: 0;">{{$consulta->paciente->edad()}}</span>
                @if ($consulta->paciente->sexo_paciente=='f')
                    <span style="position: absolute; left: 830px; top: 0;">X</span>
                @else
                    <span style="position: absolute; left: 875px; top: 0;">X</span>
                @endif
                
                <span style="position: absolute; left:900px; top: 0;">{{\Carbon\Carbon::parse($consulta->paciente->fecha_nacimiento_paciente)->format('d')}}</span>
                <span style="position: absolute; left: 980px; top: 0;">{{\Carbon\Carbon::parse($consulta->paciente->fecha_nacimiento_paciente)->format('m')}}</span>
                <span style="position: absolute; left: 1060px; top: 0;">{{\Carbon\Carbon::parse($consulta->paciente->fecha_nacimiento_paciente)->format('Y')}}</span>
            </div>
            
            <div id="fila" style="position: relative; margin-top: 10px; padding-left: 120px; height: 30px;">
                <span style="position: absolute; left: 80px; top: 0;">{{$consulta->paciente->direccion_paciente}}</span>
               
            </div> 
            <div id='fila'  style="position: relative;  @if($consulta->referencia->datos['motivoR']==6)
                                                            left: 830px; top: 120px; 
                                                        @elseif($consulta->referencia->datos['motivoR']==5) 
                                                            left: 610px; top: 120px;                                                         
                                                        @elseif($consulta->referencia->datos['motivoR']==4) 
                                                            left: 330px; top: 120px; 
                                                        @elseif($consulta->referencia->datos['motivoR']==3) 
                                                            left: 830px; top: 80px;
                                                        @elseif($consulta->referencia->datos['motivoR']==2) 
                                                            left: 610px; top: 80px;
                                                        @else
                                                            left: 330px; top: 80px;   
                                                        @endif 
                                                        height: 30px;">
                <span style="position: absolute; width: 300px;  ">X</span>
                
            </div>    
            @if($consulta->referencia->datos['motivoR']==6)
                <div id='fila'  style="position: relative; left: 860px; top: 45px;   height: 60px; ">
                    <span style="position: absolute; width: 450px;  ">{{$consulta->referencia->datos['otroMotivo']}}</span>
                    
                </div>   
            @endif
            <div id="fila"  style="position: absolute; left: 60px; top: 825px; height: 80px; ">
                <div style="position: absolute;text-align: justify; width: 1190px;
                           line-height: 1.1;
                           overflow: hidden;">
                    {{$consulta->referencia->datos['txtAmammensia']}}
                </div>
            </div>

            <div id="fila"  style="position: absolute; left: 60px; top: 1030px; height: 80px; ">
                <div style="position: absolute;text-align: justify; width: 1190px;
                           line-height: 1.1;
                           overflow: hidden;">
                        {{$consulta->referencia->datos['txtExamenFisico']}}
                </div>
            </div>
            <div id="fila" style="position: absolute; left: 5px; top: 1185px; height: 20px; width: 650px;">
                <span style="position: absolute; left: 100px;">{{ \Carbon\Carbon::parse($consulta->updated_at)->format('h:m') }}</span>       
                <span style="position: absolute; left: 200px;">{{ $consulta->referencia->datos['presionArterial'] ?? $consulta->presion_arterial ?? '---' }}</span>  
                <span style="position: absolute; left: 340px;">{{ $consulta->referencia->datos['frecuenciaCardiaca'] ?? $consulta->frecuencia_cardiaca ?? '---' }}</span>
                <span style="position: absolute; left: 520px;">{{ $consulta->referencia->datos['frecuenciaRespiratoria'] ?? $consulta->frecuencia_respiratoria ?? '---' }}</span>  
                <span style="position: absolute; left: 750px;">{{ $consulta->referencia->datos['frecuenciaCardiacaFetal'] ?? '---' }}</span>
                <span style="position: absolute; left: 1000px;">{{ $consulta->referencia->datos['temperatura'] ?? $consulta->temperatura ?? '---' }}</span>   
                <span style="position: absolute; left: 1130px;">{{ $consulta->referencia->datos['talla'] ?? $consulta->talla ?? '---' }}</span>  
                <span style="position: absolute; left: 870px;">{{ $consulta->referencia->datos['peso'] ?? $consulta->peso ?? '---' }}</span>                     
            </div>
            <div id="fila" style="position: absolute; left: 30px; top: 240px; height: 40px; width: 580px;">
                <div style="position: absolute; left: 0px; top: 0;
                           word-wrap: break-word;
                           font-size: 12px;
                           line-height: 1.1;">
                    @if(isset($consulta->referencia->datos['txtResultados']))
                        {{$consulta->referencia->datos['txtResultados']}}
                    @endif
                </div>
            </div>


            <div id="fila" style="position: absolute; left: 200px; top: 1215px; height: 40px; width: 1060px;">
                <div style="position: absolute; left: 0px; top: 0;
                            text-align: justify;
                           word-wrap: break-word;
                           line-height: 1.8;">
                    @if(isset($consulta->referencia->datos['txtDiagnostico']))
                        {{$consulta->referencia->datos['txtDiagnostico']}}
                    @endif
                </div>
            </div>
            
            <div id="fila" style="position: absolute; left: 350px; top: 1285px; height: 60px; width: 930px;">
                <div style="position: absolute; left: 0px; top: 0;text-align: justify;
                           word-wrap: break-word;
                           line-height: 1.8;">
                    @if(isset($consulta->referencia->datos['txtTratamiento']))
                        {{$consulta->referencia->datos['txtTratamiento']}}
                    @endif
                </div>
            </div>
           

        </div>
   
</body>
</html>


