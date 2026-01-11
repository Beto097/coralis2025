<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden de Exámenes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 15px;
            font-size: 12px;
        }
        .header { text-align: center; }
        .header h1 { margin: 0; color: #003366; }
        .header h2 { margin: 5px 0; font-size: 16px; }
        .section { margin-top: 10px; }
        .section h3 {
            background: #003366;
            color: white;
            padding: 5px;
            font-size: 13px;
        }
        .form-row { display: flex; flex-wrap: wrap; margin-bottom: 8px; }
        .form-row label { font-weight: bold; margin-right: 5px; }
        .form-row input { border: none; border-bottom: 1px solid #000; flex: 1; margin-right: 10px; }

        .checkbox-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 4px;
        }
        .checkbox-item {
            display: flex;
            align-items: center;
        }
        .checkbox-item input[type="checkbox"] {
            margin-right: 6px;
            transform: scale(1.1); /* un poquito más grande */
        }

        /* Ajuste impresión */
        @page {
            size: A4;
            margin: 10mm;
        }
        @media print {
            body { margin: 0; -webkit-print-color-adjust: exact; }
            .section { page-break-inside: avoid; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BIOK CHMED</h1>
        <p>LABORATORIO CLÍNICO DEL ECUADOR</p>
        <h2>ORDEN DE EXÁMENES PARA LABORATORIO CLÍNICO</h2>
    </div>

    <div class="section">
        <div class="form-row">
            <label>Nombres:</label><input type="text" value="{{$consulta->paciente->nombreCompleto()}}">
            <label>Fecha:</label><input type="text" value="{{$consulta->fecha_consulta}}" >
        </div>
        <div class="form-row">
            <label>Cédula:</label><input type="text" value="{{$consulta->paciente->identificacion_paciente}}">
            <label>Edad:</label><input type="text" style="width:50px;" value="{{$consulta->paciente->edad()}}">
            <label>Médico Solicitante:</label><input type="text" value="{{$consulta->doctor->nombreCompleto()}}">
        </div>
    </div>

    <!-- Ejemplo corregido -->
    <div class="section">
        
        <div class="checkbox-list">

            @foreach ($consulta->orden()->examenes as $examen)
                <label class="checkbox-item"><input type="checkbox" checked> {{$examen->nombre_examen}}</label>
            @endforeach
            
    
        </div>
    </div>
</body>
</html>
