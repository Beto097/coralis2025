<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
   <style>
    @page {
        size: 22in 17in;
        margin: 0;
    }

    #nRegistro{
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size:38px;
        color: red;
    }

    #fila{
        font-family: Arial, Helvetica, sans-serif;        
        font-size:35px;
        color: black;
    }

    body {
      margin: 0;
      padding: 0;
      background-image: url('img/constancia.png');
      background-size:100%; 
      background-repeat: no-repeat;
      background-position: center center;
    }

    .pagina { 
        box-sizing: border-box;
        display: flex;
        font-family: sans-serif;
    }
  </style>
  <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
    
        <div class="pagina">
            <div>    
                <p id="fila" style="padding-top: 710px; padding-left: 1550px;">{{$consulta->paciente->identificacion_paciente}} </p>
            </div>
            <div>
                <p id="fila" style="margin-top: 45px; padding-left: 1550px;">
                    @if($constancia && $constancia->fecha)
                        {{\Carbon\Carbon::parse($constancia->fecha)->format('d-m-Y')}}
                    @else
                        {{ date('d-m-Y') }}
                    @endif
                </p>
            </div>
            <div>
                <p id="fila" style="margin-top:65px; padding-left: 750px;">{{$consulta->paciente->nombre_paciente}} {{$consulta->paciente->apellido_paciente}}</p> 
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
                <p id="fila" style="margin-top: 15; padding-left: 1270px;">{{$hora_inicio12}}</p><p id="fila" style="margin-top: -60; padding-left: 1600px;">{{$hora_fin12}}</p>
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
                <p id="fila" style="margin-top:5; padding-left: 460px;">{{$dia}}</p><p id= "fila" style="margin-top: -50; padding-left: 680px;">{{$mes}}</p><p id="fila" style="margin-top: -50; padding-left: 1010px;">{{$anio}}</p>
            </div>
            <div style="position:absolute; text-align: left width: 30%; margin-top: -10px; margin-left: 300px;">
                @if($sello)
                    <img src="img/sellos/{{$consulta->doctor->nombre_usuario}}.PNG" width="300"/>
                @endif
            </div>
            <div style=" position:absolute; margin-top: -10px; margin-left: 580px;" >
                @if($firma)
                    <img src="img/firmas/{{$consulta->doctor->nombre_usuario}}.PNG" width="150"/>
                @endif
            </div>
            <div>
                <p id="fila" style="margin-top: 15px; padding-left: 1380px;">
                    @if($consulta && $consulta->responsable_menor)
                        {{$consulta->responsable_menor}} ({{$consulta->parentesco_menor}})
                    @endif
                </p>
            </div>
            <!--<div>
                <p id="fila" style="position:absolute; margin-top: 90px; padding-left: 800px;">{{$consulta->doctor->primer_nombre_usuario}} {{$consulta->doctor->apellido_usuario}}</p>
            </div>-- SE PIDIO CAMBIO EN CONSTANCIA POR LO QUE YA NO SE MUESTRA NOMBRE DOCTOR, ESTARA SELLADO MANUALMENTE> 
            
                    
           

        </div>
   
</body>
</html>


