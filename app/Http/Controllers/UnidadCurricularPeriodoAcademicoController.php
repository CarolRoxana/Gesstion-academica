<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
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
        $sedes = ArrayHelper::sedes();

        $modulos = ArrayHelper::$modulos;
        $pisos = ArrayHelper::$pisos;

        return view('admin\uc_periodo\create', compact('unidad_curricular', 'periodos', 'docentes', 'modulos', 'pisos', 'sedes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unidad_curricular_id' => 'required|exists:unidad_curricular,id',
            'periodo_academico_id' => 'required|exists:periodo_academico,id',
            'docente_id' => 'nullable|exists:docentes,id',
            'sede' => 'required|string|max:100',
            'modalidad' => 'required|in:Presencial,Virtual',
        ]);

        UnidadCurricularPeriodoAcademico::create($request->only([
            'unidad_curricular_id',
            'periodo_academico_id',
            'docente_id',
            'sede',
            'modalidad',
            // "piso",
            // "modulo",
        ]));

        return redirect()->route('admin.unidad-curricular-periodo.index')
            ->with('success', 'Registro creado exitosamente.');
    }

    public function edit($id)
    {
        $registro = UnidadCurricularPeriodoAcademico::findOrFail($id);
        $unidad_curricular = UnidadCurricular::all();
        $periodos = PeriodoAcademico::all();
        $sedes = ArrayHelper::sedes();
        $modulos = ArrayHelper::$modulos;
        $pisos = ArrayHelper::$pisos;

        return view('admin\uc_periodo\edit', compact('registro', 'unidad_curricular', 'periodos', 'modulos', 'pisos', "sedes"));
    }

    public function update(Request $request, $id)
    {
        $registro = UnidadCurricularPeriodoAcademico::findOrFail($id);

        $request->validate([
            'unidad_curricular_id' => 'required|exists:unidad_curricular,id',
            'periodo_academico_id' => 'required|exists:periodo_academico,id',
            'sede' => 'required|string|max:100',
            'modalidad' => 'required|in:Presencial,Virtual',
            'docente_id' => 'nullable|exists:docentes,id',
        ]);

        $registro->update($request->all());

        return redirect()->route('admin.unidad-curricular-periodo.index')
            ->with('success', 'Registro actualizado exitosamente.');
    }

    public function show($id)
    {
        $registro = UnidadCurricularPeriodoAcademico::with(['unidadCurricular', 'periodoAcademico'])->findOrFail($id);
        return view('admin\uc_periodo\show', compact('registro'));
    }

    public function destroy($id)
    {
        $registro = UnidadCurricularPeriodoAcademico::findOrFail($id);
        $registro->delete();

        return redirect()->route('admin.unidad-curricular-periodo.index')
            ->with('success', 'Registro eliminado exitosamente.');
    }
}
