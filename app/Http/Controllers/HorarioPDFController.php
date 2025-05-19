<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Horario;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HorarioPDFController extends Controller
{
    public function exportHorarioPDF()
    {


        // Establecer el locale en español
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'es_ES.utf8');
        //SEDE
        //SEMESTRE
        //SECCION

        $horarios = DB::table('horarios')
            ->join('docentes', 'horarios.docente_id', '=', 'docentes.id')
            ->join('unidad_curricular', 'horarios.unidad_curricular_id', '=', 'unidad_curricular.id')
            ->join("periodo_academico", "horarios.periodo_academico_id", "=", "periodo_academico.id")
            ->join("unidad_curricular_periodo_academico", "horarios.unidad_curricular_id", "=", "unidad_curricular_periodo_academico.id")
            //obten todos los valores

            ->select(
                'horarios.id',
                'horarios.docente_id',
                'horarios.dia',
                'horarios.hora_inicio',
                'horarios.hora_finalizacion',
                'horarios.unidad_curricular_id',
                'horarios.seccion_id',
                'horarios.periodo_academico_id',
                'horarios.sede',
                'horarios.aula_id',
                'docentes.nombre as docente_nombre',
                'docentes.apellido as docente_apellido',
                'unidad_curricular.nombre as unidad_curricular_nombre',
                'unidad_curricular.carrera as unidad_curricular_carrera',
                'unidad_curricular.semestre as unidad_curricular_semestre',
                'periodo_academico.periodo as periodo_academico',
                'unidad_curricular_periodo_academico.sede as sede',
                'unidad_curricular_periodo_academico.modalidad as modalidad'
            )
            ->where('horarios.periodo_academico_id', 2)
            //order by sedes
            ->orderBy('unidad_curricular_periodo_academico.sede')
            //order by semestre en unidad_curricular 
            ->orderBy('unidad_curricular.semestre')


            //order by dia 
            ->orderByRaw("
            CASE horarios.dia
            WHEN 'Lunes' THEN 1
            WHEN 'Martes' THEN 2
            WHEN 'Miércoles' THEN 3
            WHEN 'Jueves' THEN 4
            WHEN 'Viernes' THEN 5
            WHEN 'Sábado' THEN 6
            ELSE 7
            END
            ")

            //order by seccion
            ->orderBy('horarios.seccion_id')
            //order by hora_inicio
            ->orderBy('horarios.hora_inicio')
            ->orderBy('horarios.periodo_academico_id')


            ->get();

        $agrupados = [];

        foreach ($horarios as $horario) {
            $sede = $horario->sede;
            $semestre = $horario->unidad_curricular_semestre;
            $seccion = $horario->seccion_id;

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


        //dd($agrupados, );

        $titulo = "Reporte de Horarios Docentes";
  
        $fecha =  Carbon::now()->isoFormat('D [de] MMMM [de] YYYY, h:mm a');
        $pdf = Pdf::loadView('admin.horario.pdf', compact('bloques', 'horarios', "fecha", "titulo","agrupados","dias"))
            ->setPaper('A4', 'landscape');

        return $pdf->stream('horarios_' . now()->format('dmy_His') . '.pdf');
    }
}
