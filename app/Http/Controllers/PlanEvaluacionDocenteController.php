<?php

namespace App\Http\Controllers;

use App\Models\PlanEvaluacionDocente;
use App\Models\UnidadCurricularPeriodoAcademico;
use Illuminate\Http\Request;

class PlanEvaluacionDocenteController extends Controller
{
    public function index(Request $request)
    {
        $planEvaluaciones = PlanEvaluacionDocente::with([
        'unidadCurricularPeriodoAcademico.docente',
        'unidadCurricularPeriodoAcademico.unidadCurricular'
    ])->get();

    return view('admin.plan_evaluacion_docente.index', compact('planEvaluaciones'));
    }

    public function create()
    {
        $unidadCurricularPeriodoAcademico = UnidadCurricularPeriodoAcademico::with('unidadCurricular', 'periodoAcademico')->get();
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

    public function show($id)
    {
        $plan = PlanEvaluacionDocente::with('unidadCurricularPeriodoAcademico.docente', 'unidadCurricularPeriodoAcademico.unidadCurricular')
        ->findOrFail($id);

        return view('admin.plan_evaluacion_docente.show', compact('plan'));
    }

    public function edit($id)
    {
         $plan = PlanEvaluacionDocente::with('unidadCurricularPeriodoAcademico.docente', 'unidadCurricularPeriodoAcademico.unidadCurricular')
        ->findOrFail($id);

    // Si necesitas pasar más datos para selects, agrégalos aquí
    // $unidades = UnidadCurricularPeriodoAcademico::with('unidadCurricular')->get();

        return view('admin.plan_evaluacion_docente.edit', compact('plan'));
    }

    public function update(Request $request, $id)
    {
    $request->validate([
        'tipo_evaluacion' => 'required|string',
        'porcentaje_evaluacion' => 'required|integer|min:0|max:100',
        'fecha_evaluacion' => 'required|date',
    ]);

    $plan = PlanEvaluacionDocente::findOrFail($id);

    $plan->update([
        'tipo_evaluacion' => $request->tipo_evaluacion,
        'porcentaje_evaluacion' => $request->porcentaje_evaluacion,
        'fecha_evaluacion' => $request->fecha_evaluacion,
    ]);

    return redirect()->route('admin.plan_evaluacion_docente.show', $plan->id)
        ->with('success', 'Plan de evaluación actualizado correctamente.');
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
