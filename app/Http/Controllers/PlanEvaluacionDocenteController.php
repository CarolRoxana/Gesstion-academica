<?php

namespace App\Http\Controllers;

use App\Models\PlanEvaluacionDocente;
use App\Models\UnidadCurricularPeriodoAcademico;
use Illuminate\Http\Request;

class PlanEvaluacionDocenteController extends Controller
{
    public function index(Request $request)
    {
        $query = PlanEvaluacionDocente::query()->with('unidadCurricularPeriodoAcademico.docente', 'unidadCurricularPeriodoAcademico.unidadCurricular');

        if ($request->filled('docente')) {
            $docente = $request->input('docente');
            $query->whereHas('unidadCurricularPeriodoAcademico.docente', function ($q) use ($docente) {
                $q->where('nombre', 'like', "%$docente%")
                  ->orWhere('apellido', 'like', "%$docente%");
            });
        }
    
        $planEvaluaciones = $query->paginate(10); // puedes ajustar el número
    
        return view('admin.plan_evaluacion_docente.index', compact('planEvaluaciones'));
    }

    public function create()
    {
        $unidadCurricularPeriodoAcademico = UnidadCurricularPeriodoAcademico::all();
        return view('admin.plan_evaluacion_docente.create', compact('unidadCurricularPeriodoAcademico'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unidad_curricular_periodo_academico_id' => 'required|exists:unidad_curricular_periodo_academico,id',
            'porcentaje_evaluacion' => 'required|integer|min:0|max:100',
            'fecha_evaluacion' => 'required|date',
            'tipo_evaluacion' => 'required|string',
        ]);

        PlanEvaluacionDocente::create($request->all());
        return redirect()->route('admin.plan_evaluacion_docente.index')->with('success', 'Plan de evaluación creado con éxito.');
    }

    public function show($docenteId)
    {
        $evaluaciones = PlanEvaluacionDocente::with('unidadCurricularPeriodoAcademico.unidadCurricular', 'unidadCurricularPeriodoAcademico.docente')
        ->whereHas('unidadCurricularPeriodoAcademico', function ($query) use ($docenteId) {
            $query->where('docente_id', $docenteId);
        })->get();

        $docente = $evaluaciones->first()?->unidadCurricularPeriodoAcademico->docente;

        return view('admin.plan_evaluacion_docente.show', compact('evaluaciones', 'docente'));
    }

    public function edit($id)
    {
        $planEvaluacion = PlanEvaluacionDocente::findOrFail($id);
        $unidadCurricularPeriodoAcademico = UnidadCurricularPeriodoAcademico::all();
        return view('admin.plan_evaluacion_docente.edit', compact('planEvaluacion', 'unidadCurricularPeriodoAcademico'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unidad_curricular_periodo_academico_id' => 'required|exists:unidad_curricular_periodo_academico,id',
            'porcentaje_evaluacion' => 'required|integer|min:0|max:100',
            'fecha_evaluacion' => 'required|date',
            'tipo_evaluacion' => 'required|string',
        ]);

        $planEvaluacion = PlanEvaluacionDocente::findOrFail($id);
        $planEvaluacion->update($request->all());

        return redirect()->route('admin.plan_evaluacion_docente.index')->with('success', 'Plan de evaluación actualizado con éxito.');
    }

    public function destroy($id)
    {
     try {
        
            $planEvaluacion = PlanEvaluacionDocente::findOrFail($id);
            $planEvaluacion->delete();
            return redirect()->route('admin.plan_evaluacion_docente.index')->with('success', 'Plan de evaluación eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.plan_evaluacion_docente.index')->with('error', 'Error al eliminar el plan de evaluación.');
        }
    
    
    }
}
