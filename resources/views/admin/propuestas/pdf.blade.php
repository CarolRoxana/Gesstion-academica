<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }}</title>
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
        <div class="subtitle">Generado el: {{ $fecha }}</div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>
                    @if($tipo == 'grado')
                        Nombre del Tesista
                    @else
                        Nombre del Pasante
                    @endif
                </th>
                <th>Título de la Propuesta</th>
                <th>Docente Tutor</th>
                <th>Estatus</th>
                <th>Fecha de Ingreso</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($propuestas as $index => $propuesta)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($tipo == 'grado')
                            {{ $propuesta->nombre_tesista ?? 'N/A' }} {{ $propuesta->apellido_tesista ?? '' }}
                        @else
                            {{ $propuesta->nombre_pasante ?? 'N/A' }} {{ $propuesta->apellido_pasante ?? '' }}
                        @endif
                    </td>
                    <td>{{ $propuesta->titulo_propuesta }}</td>
                    <td>
                        @if($propuesta->docente)
                            {{ $propuesta->docente->nombre }} {{ $propuesta->docente->apellido }}
                        @else
                            Sin asignar
                        @endif
                    </td>
                    <td>
                        @if($propuesta->estatus == 'Aprobado')
                            <span class="badge badge-aprobado">{{ $propuesta->estatus }}</span>
                        @elseif($propuesta->estatus == 'Pendiente')
                            <span class="badge badge-pendiente">{{ $propuesta->estatus }}</span>
                        @else
                            <span class="badge badge-rechazado">{{ $propuesta->estatus }}</span>
                        @endif
                    </td>
                    <td>{{ \Carbon\Carbon::parse($propuesta->fecha_ingreso)->isoFormat('D [de] MMMM [de] YYYY') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <div class="footer">
        Sistema Académico - {{ config('app.name') }} | 
        Total de propuestas: {{ $propuestas->count() }}
    </div>
</body>
</html>