<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
   <style>
    @page {
      size: 279.4mm 215.9mm; /* Letter exacto: 8.5x11 pulgadas */
      margin: 0;
    }

    #nRegistro{
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size:10px;
        color: red;
    }

    #fila{
        font-family: Arial, Helvetica, sans-serif;        
        font-size:10px;
        color: black;
    }

    body {
      margin: 0;
      padding: 0;      
      background-image: url('img/ReferenciaV2.1.png'); 
      background-size: 279.4mm 215.9mm; /* Tamaño exacto sin escalado */
      background-repeat: no-repeat;
      background-position: 0 0; /* Posición exacta sin centrar */
      image-rendering: auto;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
      background-attachment: fixed; /* Evita redimensionamiento */
    }

    .pagina {
      width: 279.4mm;
      height: 215.9mm;
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

            <div id='fila'  style="position: absolute; left: 300px; top: 120px; height: 30px;">
                <span style="position: absolute; width: 300px;  ">Clinica Coralis</span>
                <span style="position: absolute; left: 180px; width: 300px;">{{$consulta->referencia->datos['RefiereA']}}</span>
            </div>  
               
            <div id='fila'  style="position: absolute; left: 65px; top: 140px;">
                <span style="position: absolute; left: -25px; ">{{ $fecha['dia'] }}</span>
                <span style="position: absolute; ">{{ $fecha['mes'] }}</span>
                <span style="position: absolute; left: 35px;">{{ $fecha['anio'] }}</span>
                <span style="position: absolute; left: 75px;">{{ $fecha['hora'] }}</span>
                <span style="position: absolute; left: 100px;">{{ $fecha['minuto'] }}</span>
            </div>             
            <div id='fila'  style="position: absolute; left: @if($consulta->referencia->datos['tipoR']==1) 308px @else 433px @endif; top: 155px; height: 30px;">
                <span style="position: absolute; width: 300px;  ">X</span>
                
            </div>  
            
            <div id="fila" style="position: relative; margin-top: 228px; padding-left: 100px; height: 30px;">
                <span style="position: absolute; left: 55; top: 0;">{{$consulta->paciente->nombres(1)}}</span>
                <span style="position: absolute; left: 230px; top: 0;">{{$consulta->paciente->nombres(2)}}</span>
                <span style="position: absolute; left: 350px; top: 0;">{{$consulta->paciente->apellidos(1)}}</span>
                <span style="position: absolute; left: 500px; top: 0;">{{$consulta->paciente->apellidos(2)}}</span>
            </div> 
            
            <div id="fila" style="position: relative; margin-top: 8px; padding-left: 120px; height: 30px;">
                <span style="position: absolute; left: 95px; top: 0;">{{$consulta->paciente->telefono_paciente}}</span>
                <span style="position: absolute; left: 235px; top: 0;">{{$consulta->paciente->identificacion_paciente}}</span>
                <span style="position: absolute; left: 350px; top: 0;">{{$consulta->paciente->edad()}}</span>
                @if ($consulta->paciente->sexo_paciente=='f')
                    <span style="position: absolute; left: 417px; top: 0;">X</span>
                @else
                    <span style="position: absolute; left: 437px; top: 0;">X</span>
                @endif
                
                <span style="position: absolute; left: 450px; top: 0;">{{\Carbon\Carbon::parse($consulta->paciente->fecha_nacimiento_paciente)->format('d')}}</span>
                <span style="position: absolute; left: 480px; top: 0;">{{\Carbon\Carbon::parse($consulta->paciente->fecha_nacimiento_paciente)->format('m')}}</span>
                <span style="position: absolute; left: 540px; top: 0;">{{\Carbon\Carbon::parse($consulta->paciente->fecha_nacimiento_paciente)->format('Y')}}</span>
            </div>
            
            <div id="fila" style="position: relative; margin-top: -12px; padding-left: 120px; height: 30px;">
                <span style="position: absolute; left: 80px; top: 0;">{{$consulta->paciente->direccion_paciente}}</span>
               
            </div> 
            <div id='fila'  style="position: absolute;  @if($consulta->referencia->datos['motivoR']==6)
                                                            left: 415px; top: 356px; 
                                                        @elseif($consulta->referencia->datos['motivoR']==5) 
                                                            left: 310px; top: 356px;                                                         
                                                        @elseif($consulta->referencia->datos['motivoR']==4) 
                                                            left: 170px; top: 356px; 
                                                        @elseif($consulta->referencia->datos['motivoR']==3) 
                                                            left: 415px; top: 338px;
                                                        @elseif($consulta->referencia->datos['motivoR']==2) 
                                                            left: 310px; top: 338px;
                                                        @else
                                                            left: 170px; top: 338px;   
                                                        @endif 
                                                        height: 30px;">
                <span style="position: absolute; width: 300px;  ">X</span>
                
            </div>    
            @if($consulta->referencia->datos['motivoR']==6)
                <div id='fila'  style="position: absolute; left: 460px; top: 340px;   height: 60px; ">
                    <span style="position: absolute; width: 220px;  ">{{$consulta->referencia->datos['otroMotivo']}}</span>
                    
                </div>   
            @endif
            <div id="fila"  style="position: absolute; left: 40px; top: 405px; height: 200px; width: 580px;">
                <div style="position: absolute; left: 0px; top: 0; 
                           word-wrap: break-word; 
                           word-break: break-word; 
                           hyphens: auto; 
                           -webkit-hyphens: auto; 
                           -ms-hyphens: auto; 
                           text-align: justify; 
                           line-height: 1.2;
                           overflow: hidden;">
                    {{$consulta->referencia->datos['txtAmammensia']}}
                </div>
            </div>

            <div id="fila" style="position: relative; margin-top: 315px; padding-left: 150px; height: 60px; width: 500px;">
                
                <span style="position: absolute; left: 100px;">{{ \Carbon\Carbon::parse($consulta->updated_at)->format('h:m') }}</span>       
                <span style="position: absolute; left: 200px;">{{ $consulta->presion_arterial }}</span>  
                <span style="position: absolute; left: 300px;">{{ $consulta->frecuencia_cardiaca }}</span>
                <span style="position: absolute; left: 380px;">{{ $consulta->frecuencia_respiratoria }}</span>  
                <span style="position: absolute; left: 450px;">{{ $consulta->saturacion_oxigeno}}</span>  
                <span style="position: absolute; left: 520px;">{{ $consulta->temperatura}}</span>   
                <span style="position: absolute; left: 570px;">{{ $consulta->talla}}</span>  
                <span style="position: absolute; left: 622px;">{{ $consulta->peso}}</span>                     
            </div>
            <div id="fila" style="position: absolute; left: 40px; top: 510px; height: 200px; width: 580px;">
                <div style="position: absolute; left: 0px; top: 0; 
                           word-wrap: break-word; 
                           word-break: break-word; 
                           hyphens: auto; 
                           -webkit-hyphens: auto; 
                           -ms-hyphens: auto; 
                           text-align: justify; 
                           line-height: 1.2;
                           overflow: hidden;">
                        {{$consulta->referencia->datos['txtExamenFisico']}}
                </div>
            </div>
            <div id="fila" style="position: absolute; left: -30px; top: 632px; padding-left: 150px; height: 60px; width: 500px;">
                <div style="position: absolute; left: 0px; top: 0;">
                    @if(isset($consulta->referencia->datos['txtResultados']))
                        {{$consulta->referencia->datos['txtResultados']}}
                    @endif
                </div>
            </div>


            <div id="fila" style="position: absolute; left: 120px; top: 605px; height: 60px; width: 500px;">
                <div style="position: absolute; left: 0px; top: 0;">
                    @if(isset($consulta->referencia->datos['txtDiagnostico']))
                        {{$consulta->referencia->datos['txtDiagnostico']}}
                    @endif
                </div>
            </div>
            
            <div id="fila" style="position: absolute; left: 70px; top: 705px; padding-left: 150px; height: 60px; width: 500px;">
                <div style="position: absolute; left: 140px; top: 0;">
                    @if(isset($consulta->referencia->datos['txtTratamientos']))
                        {{$consulta->referencia->datos['txtTratamientos']}}
                    @endif
                </div>
            </div>
           

        </div>
   
</body>
</html>


