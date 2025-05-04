<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
   <style>
    @page {
        size: 266.7mm 215.9mm;
        margin: 0;
    }

    #nRegistro{
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size:18px;
        color: red;
    }

    #fila{
        font-family: Arial, Helvetica, sans-serif;        
        font-size:18px;
        color: black;
    }

    body {
      margin: 0;
      padding: 0;
      background-image: url('img/constancia.png');
      background-size:98%; /* O "contain", depende de lo que quieras */
      background-repeat: no-repeat;
      background-position: center center;
    }

    .pagina {
        width: 266.7mm;  
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
            <div>    
                <p style="padding-top: 375px; padding-left: 780px;">{{$consulta->paciente->identificacion_paciente}} </p>
            </div>
            <div>
                <p style="margin-top: 10; padding-left: 780px;">{{$consulta->fecha_consulta}} </p>
            </div>
            <div>
                <p style="margin-top:30px; padding-left: 450px;">{{$consulta->paciente->nombre_paciente}} {{$consulta->paciente->apellido_paciente}}</p> 
            </div>
            @php
                $hora_inicio24 = $constancia->hora_inicio;
                $hora_fin24 = $constancia->hora_fin;
                $hora_inicio12 = \Carbon\Carbon::createFromFormat('H:i', $hora_inicio24)->format('g:i A');
                $hora_fin12 = \Carbon\Carbon::createFromFormat('H:i', $hora_fin24)->format('g:i A');
            @endphp
            <div>
                <p style="margin-top: 15; padding-left: 600px;">{{$hora_inicio12}}</p><p style="margin-top: -30; padding-left: 780px;">{{$hora_fin12}}</p>
            </div>
            
            @php
                [$anio, $mesNum, $dia] = explode('-', $consulta->fecha_consulta);
                $meses = [
                    '01' => 'enero', '02' => 'febrero', '03' => 'marzo',
                    '04' => 'abril', '05' => 'mayo', '06' => 'junio',
                    '07' => 'julio', '08' => 'agosto', '09' => 'septiembre',
                    '10' => 'octubre', '11' => 'noviembre', '12' => 'diciembre'
                ];
                $mes = $meses[$mesNum];

            @endphp
            <div>
                <p style="margin-top:-10; padding-left: 260px;">{{$dia}}</p><p style="margin-top: -30; padding-left: 400px;">{{$mes}}</p><p style="margin-top: -30; padding-left: 560px;">{{$anio}}</p>
            </div>
            <div style="text-align: left width: 10%; margin-top: -10px; margin-left: 160px;">
                @if($sello)
                    <img src="img/sellos/{{$consulta->doctor->nombre_usuario}}.PNG" width="150"/>
                @endif
            </div>
            <div style=" margin-top: -800px; margin-left: 580px;" >
                @if($firma)
                    <img src="img/firmas/{{$consulta->doctor->nombre_usuario}}.PNG" width="150"/>
                @endif
            </div>
            <div>
                <p style="margin-top: -70px; padding-left: 400px;">{{$consulta->doctor->primer_nombre_usuario}} {{$consulta->doctor->apellido_usuario}}</p>
            </div>
            
                    
           

        </div>
   
</body>
</html>


