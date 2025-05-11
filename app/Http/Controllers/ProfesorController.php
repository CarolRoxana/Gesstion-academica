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
        ->leftJoin('seccions as s', 's.unidad_curricular_id', '=', 'uc.id')
        ->select(
            'ucpa.sede',
            DB::raw("CONCAT(docentes.nombre, ' ', docentes.apellido) as docente"),
            'docentes.cedula',
            'docentes.correo',
            'uc.carrera',
            'uc.nombre as unidad_curricular',
            DB::raw("COUNT(DISTINCT s.id) as num_secciones"),
            'ucpa.modalidad'
        )
        ->groupBy(
            'ucpa.sede',
            'docentes.nombre',
            'docentes.apellido',
            'docentes.cedula',
            'docentes.correo',
            'uc.carrera',
            'uc.nombre',
            'ucpa.modalidad'
        )
        ->get();

    return view('admin.profesores.index', compact('profesores'));
}

}
