<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Horario;
use App\Models\PeriodoAcademico;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HorarioPDFController extends Controller
{
    public function exportHorarioPDF($periodo)
    {

        if (!$periodo) {
            $mensaje = "<div style='padding: 8px 0; background:#d9534f; color:#fff; border-radius:4px; text-align:center;'>";
            $mensaje .= "<span style='font-weight:bold;'>El período académico seleccionado no existe o no es válido.</span>";
            $mensaje .= "</div>";
            return back()->withErrors(['conflicto' => $mensaje])->withInput();
        }
        $data_periodo = PeriodoAcademico::find($periodo);

        if (!$data_periodo) {
            $mensaje = "<div style='padding: 8px 0; background:#d9534f; color:#fff; border-radius:4px; text-align:center;'>";
            $mensaje .= "<span style='font-weight:bold;'>El período académico seleccionado no existe o no es válido.</span>";
            $mensaje .= "</div>";
            return back()->withErrors(['conflicto' => $mensaje])->withInput();
        }

        // dd("hola",$periodo,$data_periodo);

        // Establecer el locale en español
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'es_ES.utf8');
        //SEDE
        //SEMESTRE
        //SECCION

        $horarios = DB::table('horarios')
            ->join('docentes', 'horarios.docente_id', '=', 'docentes.id')
            ->join('unidad_curricular', 'horarios.unidad_curricular_id', '=', 'unidad_curricular.id')
            ->join('seccions', 'horarios.seccion_id', '=', 'seccions.id')

            ->join('unidad_curricular_periodo_academico', function ($join) {
                $join->on('unidad_curricular_periodo_academico.unidad_curricular_id', '=', 'horarios.unidad_curricular_id')
                    ->on('unidad_curricular_periodo_academico.periodo_academico_id', '=', 'horarios.periodo_academico_id');
            })
            ->join('periodo_academico', 'horarios.periodo_academico_id', '=', 'periodo_academico.id')
            ->select(
                'horarios.id',
                'horarios.docente_id',
                'horarios.dia',
                DB::raw("CASE dia
            WHEN 'Lunes' THEN 1
            WHEN 'Martes' THEN 2
            WHEN 'Miércoles' THEN 3
            WHEN 'Jueves' THEN 4
            WHEN 'Viernes' THEN 5
            WHEN 'Sábado' THEN 6
            ELSE 7 END as dia_orden"),
                'horarios.hora_inicio',
                'horarios.hora_finalizacion',
                'horarios.unidad_curricular_id',
                'seccions.nombre as seccion_nombre',
                'horarios.periodo_academico_id',
                'horarios.sede',
                'horarios.aula_id',
                'horarios.modulo',
                'horarios.piso',
                'docentes.nombre as docente_nombre',
                'docentes.apellido as docente_apellido',
                'unidad_curricular.nombre as unidad_curricular_nombre',
                'unidad_curricular.carrera as unidad_curricular_carrera',
                'unidad_curricular.semestre as unidad_curricular_semestre',
                'periodo_academico.periodo as periodo_academico',
                'unidad_curricular_periodo_academico.modalidad as modalidad'
            )
            ->distinct()
            ->where('horarios.periodo_academico_id', $data_periodo->id)
            ->orderBy('horarios.sede')
            ->orderBy('unidad_curricular.semestre')
            ->orderBy('dia_orden')
            ->orderBy('seccion_nombre')
            ->orderBy('horarios.hora_inicio')
            ->orderBy('horarios.periodo_academico_id')
            ->get();





        $agrupados = [];

        foreach ($horarios as $horario) {
            $sede = $horario->sede;
            $semestre = $horario->unidad_curricular_semestre;
            $seccion = $horario->seccion_nombre;

            if (!isset($agrupados[$sede])) {
                $agrupados[$sede] = [];
            }
            if (!isset($agrupados[$sede][$semestre])) {
                $agrupados[$sede][$semestre] = [];
            }
            if (!isset($agrupados[$sede][$semestre][$seccion])) {
                $agrupados[$sede][$semestre][$seccion] = [];
            }

            $agrupados[$sede][$semestre][$seccion][] = $horario;
        }

        foreach ($agrupados as $sede => &$semestres) {
            // Ordenar los semestres numéricamente
            ksort($semestres, SORT_NUMERIC);
            foreach ($semestres as $semestre => &$secciones) {
                // Ordenar las secciones numéricamente
                ksort($secciones, SORT_NUMERIC);
            }
        }
        unset($semestres); // Limpia la referencia
        unset($secciones);

        $bloques = ArrayHelper::bloques();
        $dias = ArrayHelper::$dias;



        //dd($agrupados, $horarios);

        $titulo = "Reporte de Horarios Docentes";

        $fecha =  Carbon::now()->isoFormat('D [de] MMMM [de] YYYY, h:mm a');
        $pdf = Pdf::loadView('admin.horario.pdf', compact('bloques', 'horarios', "fecha", "titulo", "agrupados", "dias"))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('horarios_' . now()->format('dmy_His') . '.pdf');
    }
}
