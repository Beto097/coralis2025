<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  @php
    // Determinar qué exámenes mostrar según el tipo
    if(isset($tipo) && $tipo === 'estudio') {
        // Para estudios, obtener la orden de estudios
        $orden = $consulta->ordenEstudio();
        $tipoExamen = 2;
        $tituloDocumento = 'ORDEN DE ESTUDIOS';
    } else {
        // Para laboratorio (por defecto)
        $orden = $consulta->tieneOrden() ? $consulta->orden() : null;
        $tipoExamen = 1;
        $tituloDocumento = 'ORDEN DE LABORATORIO';
    }
    
    // Obtener exámenes filtrados por tipo
    $examenes = $orden ? $orden->examenes->where('tipo_examen_id', $tipoExamen) : collect();
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
      @if(isset($tipo) && $tipo === 'estudio')
        background-image: url('{{ public_path('img/MembreteOrdenEst.png') }}');
      @else
        background-image: url('{{ public_path('img/MembreteOrdenLab.png') }}');
      @endif
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

    .checkbox-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 8px;
            margin-top: 20px;
            padding-left: 205px;
            max-width: 700px;
        }
        .checkbox-item {
            display: flex;
            align-items: center;
            margin-bottom: 3px;
            font-family: sans-serif;
            font-size: 20px;
            color: black;
        }
        .checkbox-item input[type="checkbox"] {
            margin-right: 8px;
            transform: scale(1.0);
            width: 14px;
            height: 14px;
        }
        .section {
            position: relative;
            margin-top: 0px;
        }
  </style>
  <!-- CSS only -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous"> -->
</head>
<body>
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

                <!-- Sección de checkboxes ordenada -->
                <div class="section" style="margin-top: 135px; padding-left: 60px;max-width: 1000px">
                    <div class="checkbox-list" >
                        @foreach ($examenes->take(15) as $examen)
                            <label class="checkbox-item">
                                <input type="checkbox" checked> {{$examen->nombre_examen}}
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- Si hay más de 15 exámenes, crear páginas adicionales --}}
        @if($examenes->count() > 15)
            @php
                $examenesRestantes = $examenes->skip(15);
                $paginasAdicionales = $examenesRestantes->chunk(15); // 15 elementos por página adicional
            @endphp
            
            @foreach($paginasAdicionales as $paginaExamenes)
                <div style="page-break-before: always;"></div>
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

                        <!-- Continuación de la lista de exámenes -->
                        <div class="section" style="margin-top: 135px; padding-left: 60px;max-width: 1000px">
                            <div class="checkbox-list">
                                @foreach ($paginaExamenes as $examen)
                                    <label class="checkbox-item">
                                        <input type="checkbox" checked> {{$examen->nombre_examen}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
</body>
</html>