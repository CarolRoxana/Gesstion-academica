<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ProfesorController extends Controller
{
    public function index()
    {
        $profesores = DB::table('horarios')
            ->join('docentes', 'horarios.docente_id', '=', 'docentes.id')
            ->join('unidad_curricular', 'horarios.unidad_curricular_id', '=', 'unidad_curricular.id')
            ->join('seccions', 'horarios.seccion_id', '=', 'seccions.id')
            ->join('unidad_curricular_periodo_academico', function ($join) {
                $join->on('unidad_curricular_periodo_academico.unidad_curricular_id', '=', 'horarios.unidad_curricular_id')
                    ->on('unidad_curricular_periodo_academico.periodo_academico_id', '=', 'horarios.periodo_academico_id');
            })
            ->join('periodo_academico', 'horarios.periodo_academico_id', '=', 'periodo_academico.id')
            ->select(
                'horarios.sede as sede',
                DB::raw("CONCAT(docentes.nombre, ' ', docentes.apellido) as docente"),
                'docentes.cedula',
                'docentes.correo',
                'unidad_curricular.carrera as carrera',
                'unidad_curricular.nombre as unidad_curricular',
                DB::raw('COUNT(DISTINCT horarios.seccion_id) as num_secciones'),
                'unidad_curricular_periodo_academico.modalidad as modalidad'
            )
            ->groupBy(
                'horarios.sede',
                'docentes.nombre',
                'docentes.apellido',
                'docentes.cedula',
                'docentes.correo',
                'unidad_curricular.carrera',
                'unidad_curricular.nombre',
                'unidad_curricular_periodo_academico.modalidad'
            )
            ->get();

        return view('admin.profesores.index', compact('profesores'));
    }

     public function export()
    {
        // Puedes crear un export personalizado, aquí un ejemplo básico:
        return Excel::download(new \App\Exports\ProfesoresExport, 'profesores.xlsx');
    }
}