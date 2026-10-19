<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
   <style>
    @page {
        size: 17in 22in;
        margin: 1mm;
    }

    #nRegistro{
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size:35px;
        color: red;
    }

    #fila{
        font-family: Arial, Helvetica, sans-serif;        
        font-size:25px;
        color: black;
        width: 60%;
    }

    #head{
        font-family: Helvetica, sans-serif;
        font-size:20px;
        color: black;
    }

    #bodyMed{
        font-family: Helvetica, sans-serif;
        font-size:25px;
        color: black;
        width: 60%;
    }

        body {
            margin: 0;
            padding: 0;
    }

    .pagina {
            width: 100%;
            height: 100%;
      box-sizing: border-box;
      font-family: sans-serif;
      position: relative;
    }

    .contenido-derecho {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 12.02in;
            background-image: url('{{ public_path('img/constancia.png') }}');
            background-size: 100% 100%;
            background-repeat: no-repeat;
        }

        .contenido-derecho p#fila {
            position: absolute;
            width: auto;
            margin: 0;
            padding: 0;
            white-space: nowrap;
        }

        .campo-identificacion { left: 70%; top: 43.8%; }
        .campo-fecha { left: 70%; top: 50.5%; }
        .campo-paciente { left: 37%; top: 58.3%; }
        .campo-hora-inicio { left: 58%; top: 63.8%; }
        .campo-hora-fin { left: 73%; top: 63.8%; }
        .campo-dia { left: 24%; top: 68%; }
        .campo-mes { left: 34%; top: 68%; }
        .campo-anio { left: 47%; top: 68%; }
        .campo-responsable { left: 63.5%; top: 73.3%; max-width: 44%; white-space: normal !important; }

        .sello-medico {
            position: absolute;
            left: 21%;
            top: 83%;
            width: 18%;
        }

        .firma-medico {
            position: absolute;
            left: 39%;
            top: 85%;
            width: 9%;
    }
  </style>
  <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    
        <div class="pagina">
          <div class="contenido-derecho">
            <div>    
                <p id="fila" class="campo-identificacion">{{$consulta->paciente->identificacion_paciente}} </p>
            </div>
            <div>
                <p id="fila" class="campo-fecha">
                    @if($constancia && $constancia->fecha)
                        {{\Carbon\Carbon::parse($constancia->fecha)->format('d-m-Y')}}
                    @else
                        {{ date('d-m-Y') }}
                    @endif
                </p>
            </div>
            <div>
                <p id="fila" class="campo-paciente">{{$consulta->paciente->nombre_paciente}} {{$consulta->paciente->apellido_paciente}}</p>
            </div>
            @php
                if($constancia && $constancia->hora_inicio && $constancia->hora_fin) {
                    $hora_inicio24 = $constancia->hora_inicio;
                    $hora_fin24 = $constancia->hora_fin;
                    $hora_inicio12 = \Carbon\Carbon::createFromFormat('H:i', $hora_inicio24)->format('g:i A');
                    $hora_fin12 = \Carbon\Carbon::createFromFormat('H:i', $hora_fin24)->format('g:i A');
                } else {
                    $hora_inicio12 = '8:00 AM';
                    $hora_fin12 = '5:00 PM';
                }
            @endphp
            <div>
                <p id="fila" class="campo-hora-inicio">{{$hora_inicio12}}</p><p id="fila" class="campo-hora-fin">{{$hora_fin12}}</p>
            </div>
            
            @php
                if($constancia && $constancia->fecha) {
                    [$anio, $mesNum, $dia] = explode('-', $constancia->fecha);
                } else {
                    [$anio, $mesNum, $dia] = explode('-', date('Y-m-d'));
                }
                $meses = [
                    '01' => 'enero', '02' => 'febrero', '03' => 'marzo',
                    '04' => 'abril', '05' => 'mayo', '06' => 'junio',
                    '07' => 'julio', '08' => 'agosto', '09' => 'septiembre',
                    '10' => 'octubre', '11' => 'noviembre', '12' => 'diciembre'
                ];
                $mes = $meses[$mesNum];
            @endphp
            <div>
                <p id="fila" class="campo-dia">{{$dia}}</p><p id="fila" class="campo-mes">{{$mes}}</p><p id="fila" class="campo-anio">{{$anio}}</p>
            </div>
            <div>
                @if($sello)
                    <img class="sello-medico" src="img/sellos/{{$consulta->doctor->nombre_usuario}}.PNG"/>
                @endif
            </div>
            <div>
                @if($firma)
                    <img class="firma-medico" src="img/firmas/{{$consulta->doctor->nombre_usuario}}.PNG"/>
                @endif
            </div>
            <div>
                <p id="fila" class="campo-responsable">
                    @if($consulta && $consulta->responsable_menor)
                        {{$consulta->responsable_menor}} ({{$consulta->parentesco_menor}})
                    @endif
                </p>
            </div>
            <!--<div>
                <p id="fila" style="position:absolute; margin-top: 90px; padding-left: 800px;">{{$consulta->doctor->primer_nombre_usuario}} {{$consulta->doctor->apellido_usuario}}</p>
            </div>-- SE PIDIO CAMBIO EN CONSTANCIA POR LO QUE YA NO SE MUESTRA NOMBRE DOCTOR, ESTARA SELLADO MANUALMENTE> 
            
                    
           

                    </div>
        </div>
   
</body>
</html>