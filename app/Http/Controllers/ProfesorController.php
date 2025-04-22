<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\DocentesExport;
use Maatwebsite\Excel\Facades\Excel;

class ProfesorController extends Controller
{
    public function index()
    { 
        $profesores = DB::table('unidad_curricular_periodo_academico as ucpa')
        ->join('docentes', 'ucpa.docente_id', '=', 'docentes.id')
        ->join('unidad_curricular as uc', 'uc.id', '=', 'ucpa.unidad_curricular_id')
        ->select(
            'ucpa.sede',
            DB::raw("CONCAT(docentes.nombre, ' ', docentes.apellido) as docente"),
            'docentes.cedula',
            'docentes.correo',
            'uc.carrera',
            'uc.nombre as unidad_curricular',
            DB::raw("(
                SELECT COUNT(DISTINCT h.seccion) 
                FROM horarios h 
                WHERE h.docente_id = docentes.id
                AND h.unidad_curricular_id = uc.id
                AND h.periodo_academico_id = ucpa.periodo_academico_id
            ) as num_secciones"),
            'ucpa.modalidad'
        )
        ->get();

    return view('admin.profesores.index', compact('profesores'));
    }

    public function export()
    {
        return Excel::download(new DocentesExport, 'lista_docentes.xlsx');
    }
}
