<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Horarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 12px;
            color: #555;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #343a40;
            color: white;
            padding: 6px;
            text-align: left;
        }
        td {
            padding: 5px;
            border: 1px solid #ddd;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .footer {
            margin-top: 20px;
            text-align: right;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">{{ $titulo }}</div>
        <div class="subtitle">Generado: {{ $fecha }}</div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Docente</th>
                <th>Cédula</th>
                <th>Materia</th>
                <th>Sección</th>
                <th>Día</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th>Duración</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($horarios as $index => $horario)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $horario->docente->apellido }}, {{ $horario->docente->nombre }}</td>
                    <td>{{ $horario->docente->cedula }}</td>
                    <td>{{ $horario->unidadCurricular->nombre }}</td>
                    <td>{{ $horario->seccion }}</td>
                    <td>{{ \Carbon\Carbon::parse($horario->dia)->isoFormat('dddd DD/MM/YYYY') }}</td>
                    <td>{{ \Carbon\Carbon::parse($horario->hora_inicio)->format('h:i A') }}</td>
                    <td>{{ \Carbon\Carbon::parse($horario->hora_finalizacion)->format('h:i A') }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($horario->hora_inicio)
                            ->diff(\Carbon\Carbon::parse($horario->hora_finalizacion))
                            ->format('%Hh %Im') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        Sistema Académico - {{ config('app.name') }}
    </div>
</body>
</html>