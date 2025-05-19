<?php

namespace App\Http\Controllers;

use App\Models\DesempenoDocente;
use App\Models\Docente;
use App\Models\UnidadCurricularPeriodoAcademico;
use Illuminate\Http\Request;

class DesempenoDocenteController extends Controller
{
    public function index(Request $request)
    {    $query = DesempenoDocente::with([
        'docente',
        'unidadCurricularPeriodoAcademico.unidadCurricular',
        'unidadCurricularPeriodoAcademico.periodoAcademico',
    ]);

    if ($request->filled('docente_id')) {
        $query->where('docente_id', $request->docente_id);
    }

    // 10 registros por página
    $desempenos = $query->paginate(10);

    $docentes = Docente::orderBy('apellido')->get();

    return view('admin.desempeno_docente.index', compact('desempenos', 'docentes'));
    }

    public function create()
    {
        $docentes = Docente::all();
        $unidadCurricularPeriodo = UnidadCurricularPeriodoAcademico::with([
            'unidadCurricular',
            'periodoAcademico'
        ])->get();

        return view('admin.desempeno_docente.create', [
            'docentes' => $docentes,
            'unidadCurricularPeriodo' => $unidadCurricularPeriodo,
            'evaluacion' => null,
        ]);
    }

    public function show(DesempenoDocente $desempenoDocente)
    {
        $evaluacion = $desempenoDocente->load([
            'docente',
            'unidadCurricularPeriodoAcademico.unidadCurricular',
            'unidadCurricularPeriodoAcademico.periodoAcademico'
        ]);

        return view('admin.desempeno_docente.show', compact('evaluacion'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'unidad_curricular_periodo_academico_id' => 'required|exists:unidad_curricular_periodo_academico,id',
             'puntualidad' => 'required|integer|min:1|max:100',
            'calidad_ensenanza' => 'required|string',
            'observaciones' => 'nullable|string',
            'participacion_proyectos' => 'required|string',
            'cumplimiento_administrativo' => 'required|string',
            'evaluado_por' => 'required|exists:docentes,id',
            'fecha_evaluacion' => 'required|date',
        ]);

        DesempenoDocente::create($request->all());

        return redirect()->route('admin.desempeno-docente.index')->with('success', 'Desempeño docente creado correctamente.');
    }

    public function edit(DesempenoDocente $desempenoDocente)
    {
        $docentes = Docente::all();
        $unidades = UnidadCurricularPeriodoAcademico::all();
        return view('admin.desempeno_docente.edit', compact('desempenoDocente', 'docentes', 'unidades'));
    }

    public function update(Request $request, DesempenoDocente $desempenoDocente)
    {
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'unidad_curricular_periodo_academico_id' => 'required|exists:unidad_curricular_periodo_academico,id',
            'puntualidad' => 'required|integer|min:1|max:100',
            'calidad_ensenanza' => 'required|string',
            'observaciones' => 'nullable|string',
            'participacion_proyectos' => 'required|string',
            'cumplimiento_administrativo' => 'required|string',
            'evaluado_por' => 'required|exists:docentes,id',
            'fecha_evaluacion' => 'required|date',
        ]);

        $desempenoDocente->update($request->all());

        return redirect()->route('admin.desempeno-docente.index')->with('success', 'Desempeño docente actualizado correctamente.');
    }

    public function destroy(DesempenoDocente $desempenoDocente)
    {
        $desempenoDocente->delete();
        return redirect()->route('admin.desempeno-docente.index')->with('success', 'Desempeño docente eliminado correctamente.');
    }
}