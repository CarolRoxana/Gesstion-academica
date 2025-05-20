@php
    use Carbon\Carbon;
@endphp

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Horarios</title>
    <style>
        .page-break {
            page-break-after: always;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        th,
        td {
            border: 1px solid #222;
            text-align: center;

            padding: 8px;
            /* reducido */
            font-size: 11px;
            /* más pequeño */
        }

        th {
            background: #eaeaea;
        }

        .hora {
            width: 100px;
            font-weight: bold;
        }

        h3 {
            margin-top: 30px;
            margin-bottom: 10px;
        }

        .header,
        .footer {
            margin-bottom: 20px;
            text-align: center;
        }

        .title {
            font-size: 18px;
            font-weight: bold;
        }

        .subtitle {
            font-size: 12px;
            color: #555;
        }
    </style>
</head>

<body>

    <div class="header">
        <div class="title">{{ $titulo }}</div>
        <div class="subtitle">Generado: {{ $fecha }}</div>
    </div>

    @foreach ($agrupados as $sede => $semestres)
        @foreach ($semestres as $semestre => $secciones)
            @foreach ($secciones as $seccion => $horarios)
                @php
                    $first = $horarios[0];
                    $ocupadas = [];
                @endphp

                @if (!$loop->first)
                    <div class="page-break"></div>
                @endif

                <h3 style="text-align: center;">
                    Sede: {{ $sede }} |
                    Semestre: {{ $first->unidad_curricular_semestre ?? $semestre }} |
                    Sección: {{ $seccion }}
                </h3>

                <table>
                    <thead>
                        <tr>
                            <th class="hora">Hora</th>
                            @foreach ($dias as $dia)
                                <th>{{ $dia }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bloques as $i => $bloque)
                            <tr>
                                <td class="hora">
                                    {{ $bloque['start'] }} - {{ $bloque['end'] }}
                                </td>
                                @foreach ($dias as $dia)
                                    @php
                                        // Verificar si ya se imprimió por rowspan
                                        $bloqueKey = $i . '_' . $dia;
                                        if (isset($ocupadas[$bloqueKey])) {
                                            continue;
                                        }

                                        $contenido = '';
                                        $rowspan = 1;

                                        foreach ($horarios as $h) {
                                            if ($h->dia !== $dia) {
                                                continue;
                                            }

                                            $horaInicio = Carbon::parse($h->hora_inicio)->format('H:i');
                                            $horaFin = Carbon::parse($h->hora_finalizacion)->format('H:i');
                                            $bloqueInicio = Carbon::parse($bloque['start'])->format('H:i');

                                            // si este bloque es el inicio de ese horario
                                            if ($horaInicio === $bloqueInicio) {
                                                // contar cuántos bloques abarca
                                                $rowspan = 0;
                                                foreach (array_slice($bloques, $i) as $j => $b) {
                                                    $bFin = Carbon::parse($b['end'])->format('H:i');
                                                    if ($bFin <= $horaFin) {
                                                        $rowspan++;
                                                        $ocupadas[$i + $j . '_' . $dia] = true;
                                                    } else {
                                                        break;
                                                    }
                                                }

                                                if (isset($h->modalidad) && $h->modalidad !== 'Virtual') {
                                                    $contenido =
                                                        '<strong>' .
                                                        $h->unidad_curricular_nombre .
                                                        '</strong><br>' .
                                                        $h->docente_nombre .
                                                        ' ' .
                                                        $h->docente_apellido .
                                                        '<br>' .
                                                        'Módulo: ' .
                                                        ($h->modulo ?? '-') .
                                                        '<br>' .
                                                        'Piso: ' .
                                                        ($h->piso ?? '-') .
                                                        '<br>' .
                                                        $h->modalidad .
                                                        '<br>' .
                                                        'A - ' .
                                                        $h->aula_id;
                                                } else {
                                                    $contenido =
                                                        '<strong>' .
                                                        $h->unidad_curricular_nombre .
                                                        '</strong><br>' .
                                                        $h->docente_nombre .
                                                        ' ' .
                                                        $h->docente_apellido .
                                                        '<br>' .
                                                        ($h->modalidad ?? 'Virtual');
                                                }

                                                break;
                                            }
                                        }
                                    @endphp
                                    @if ($contenido)
                                        <td rowspan="{{ $rowspan }}">{!! $contenido !!}</td>
                                    @else
                                        <td></td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        @endforeach
    @endforeach

    <div class="footer">
        Sistema Académico - {{ config('app.name') }}
    </div>
</body>

</html>
