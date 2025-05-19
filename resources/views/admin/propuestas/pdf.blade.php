<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{{ $titulo }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            font-size: 11px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #4b70dd;
            padding-bottom: 10px;
        }
        .title {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 12px;
            color: #7f8c8d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px 4px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #f2f6fc;
            color: #2c3e50;
            font-size: 10px;
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .badge {
            padding: 3px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .badge-aprobado {
            background-color: #d4edda;
            color: #155724;
        }
        .badge-pendiente {
            background-color: #fff3cd;
            color: #856404;
        }
        .badge-rechazado {
            background-color: #f8d7da;
            color: #721c24;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            color: #7f8c8d;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
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
                <th width="5%">#</th>
                <th width="26%">
                    @if($tipo == 'grado')
                        Nombre(s) del/los Tesista(s)
                    @else
                        Nombre del Pasante
                    @endif
                </th>
                <th width="30%">Título de la Propuesta</th>
                <th width="18%">Docente Tutor</th>
                <th width="10%">Estatus</th>
                <th width="11%">Fecha de Ingreso</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($propuestas as $index => $propuesta)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        @if($tipo == 'grado')
                            {{ $propuesta->nombre_tesista ?? 'N/A' }} {{ $propuesta->apellido_tesista ?? '' }}
                            
                            @if(isset($propuesta->nombre_tesista2) && !empty($propuesta->nombre_tesista2))
                                <br>{{ $propuesta->nombre_tesista2 }} {{ $propuesta->apellido_tesista2 }}
                            @endif
                            
                            @if(isset($propuesta->nombre_tesista3) && !empty($propuesta->nombre_tesista3))
                                <br>{{ $propuesta->nombre_tesista3 }} {{ $propuesta->apellido_tesista3 }}
                            @endif
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
                    <td>{{ \Carbon\Carbon::parse($propuesta->fecha_ingreso)->format('d/m/Y') }}</td>
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