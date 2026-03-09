<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  @php
    // Para estudios, obtener los estudios directamente
    $estudios = $consulta->estudios;
    $tituloDocumento = 'ORDEN DE ESTUDIOS';
  @endphp
   <style>
    @page {
        size: 22in 17in; /* Letter size landscape (horizontal) */
        margin: 1mm;
    }

    #nRegistro{
        font-family: Arial, Helvetica, sans-serif;
        font-weight: bold;
        font-size:35px;
        color: transparent;
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
      background-image: url('{{ public_path('img/MembreteOrdenEst.png') }}');
      background-size: 50% auto; /* Ajustar imagen a todo el ancho */
      background-repeat: no-repeat;
      background-position: left center; /* Posicionar a la izquierda */
    }

    .pagina {
      width: 100%; /* Usar todo el ancho */
      height: 100vh;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      font-family: sans-serif;
      position: relative;
    }

    .contenido-derecho {
      width: 100%; /* Usar todo el ancho */
      height: 100%;
      position: relative;
      margin-left: 0%; /* Sin margen izquierdo */
    }

        .bullet-list {
            list-style-type: disc;
            -webkit-column-count: 2;
            -moz-column-count: 2;
            column-count: 2;
            column-gap: 40px;
            margin-top: 20px;
            padding-left: 225px;
            max-width: 700px;
            font-size:25px;
        }
        .bullet-item {
            font-family: sans-serif;
            font-size: 20px;
            color: black;
            margin-bottom: 6px;
            break-inside: avoid;
            -webkit-column-break-inside: avoid;
            page-break-inside: avoid;
            font-size:25px;
        }
        .section {
            position: relative;
            margin-top: 0px;
            font-family: Arial, Helvetica, sans-serif;
            font-size:25px;
        }
  </style>
  <!-- CSS only -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
</head>
<body>
                @foreach ($estudios as $estudio)
                    @if(!$loop->first)
                        <div style="page-break-before: always;"></div>
                    @endif
                    <div class="pagina">
                        <div class="contenido-derecho">
                            <div>
                                <p id="nRegistro" style="padding-top: 163px; padding-left: 750px;">.</p>
                            </div>
                            <div>
                                <p id="head" style="margin-top: 201px; padding-left: 226px;">{{$consulta->paciente->nombre_paciente}} {{$consulta->paciente->apellido_paciente}}</p>
                            </div>
                            <div>
                                <p id="head" style="margin-top: -45px; padding-left: 750px;">{{\Carbon\Carbon::parse($consulta->fecha_consulta)->format('d-m-Y') }} </p>
                            </div>
                            <div>
                                <p id="head" style="margin-top: 0px; padding-left: 350px;">
                                    {{ \Carbon\Carbon::parse($consulta->paciente->fecha_nacimiento_paciente)->format('d-m-Y') }}
                                </p>
                            </div>
                            <div>
                                <p id="head" style="margin-top: -45px; padding-left: 750px;">
                                    {{ \Carbon\Carbon::parse($consulta->paciente->fecha_nacimiento_paciente)->age }}
                                </p>
                            </div>
                            <div>
                                <p id="head" style="margin-top: 8px; padding-left: 205px;">{{$consulta->paciente->identificacion_paciente}} </p>
                            </div>
                            <div>
                                <p id="fila" style="margin-top: 70px; padding-left: 205px;max-width: 700px">{!! $consulta->diagnostico ? e($consulta->diagnostico) : '&nbsp;' !!}</p>
                            </div>
                            <div class="section" style="margin-top: 135px; padding-left: 60px;max-width: 800px">
                                <ul class="bullet-list">
                                    <li class="bullet-item">{{$estudio->estudio}}</li>
                                </ul>
                            </div>
                            <div>
                                <p id="fila" style="margin-top: 200px; padding-left: 205px;max-width: 700px">{{$estudio->informe_clinico}}</p>
                            </div>
                            </div>
                        </div>
                    </div>
                @endforeach
</body>
</html>