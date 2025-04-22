<?php

namespace App\Http\Controllers;

use App\Models\UnidadCurricularPeriodoAcademico;
use App\Models\UnidadCurricular;
use App\Models\PeriodoAcademico;
use App\Models\Docente;
use Illuminate\Http\Request;

class UnidadCurricularPeriodoAcademicoController extends Controller
{
    public function index()
    {
        $registros = UnidadCurricularPeriodoAcademico::with(['unidadCurricular', 'periodoAcademico', 'docente'])->get();
        return view('admin\uc_periodo\index', compact('registros'));
    }

    public function create()
    {
        $unidad_curricular = UnidadCurricular::all();
        $periodos = PeriodoAcademico::all();
        $docentes = Docente::all();

        return view('admin\uc_periodo\create', compact('unidad_curricular', 'periodos', 'docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unidad_curricular_id' => 'required|exists:unidad_curricular,id',
            'periodo_academico_id' => 'required|exists:periodo_academico,id',
            'docente_id' => 'required|exists:docentes,id',
            'sede' => 'required|string|max:100',
            'modalidad' => 'required|string|max:100',
        ]);

        UnidadCurricularPeriodoAcademico::create($request->all());

        return redirect()->route('admin\uc_periodo\index')->with('success', 'Registro creado exitosamente.');
    }

    public function edit($id)
    {
        $registro = UnidadCurricularPeriodoAcademico::findOrFail($id);
        $unidad_curricular = UnidadCurricular::all();
        $periodos = PeriodoAcademico::all();
        $docentes = Docente::all();

        return view('admin\uc_periodo\edit', compact('registro', 'unidad_curricular', 'periodos', 'docentes'));
    }

    public function update(Request $request, $id)
    {
        $registro = UnidadCurricularPeriodoAcademico::findOrFail($id);

        $request->validate([
            'unidad_curricular_id' => 'required|exists:unidad_curricular,id',
            'periodo_academico_id' => 'required|exists:periodo_academico,id',
            'docente_id' => 'required|exists:docentes,id',
            'sede' => 'required|string|max:100',
            'modalidad' => 'required|string|max:100',
        ]);

        $registro->update($request->all());

        return redirect()->route('admin\uc_periodo\index')->with('success', 'Registro actualizado correctamente.');
    }

    public function show($id)
    {
        $registro = UnidadCurricularPeriodoAcademico::with(['unidadCurricular', 'periodoAcademico', 'docente'])->findOrFail($id);
        return view('admin\uc_periodo\show', compact('registro'));
    }

    public function destroy($id)
    {
        $registro = UnidadCurricularPeriodoAcademico::findOrFail($id);
        $registro->delete();

        return redirect()->route('admin\uc_periodo\index')->with('success', 'Registro eliminado correctamente.');
    }
}
