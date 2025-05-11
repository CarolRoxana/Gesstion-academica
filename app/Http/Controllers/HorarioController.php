<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Docente;
use App\Models\UnidadCurricular;
use App\Models\PeriodoAcademico;
use App\Models\Seccion;

class HorarioController extends Controller
{
  
    public function index(Request $request)
    {
        $docentes = Docente::orderBy('apellido')->get();

        $horarios = Horario::with(['docente', 'unidadCurricular', 'periodoAcademico'])
            ->when($request->filled('docente_id'), function ($query) use ($request) {
                $query->where('docente_id', $request->docente_id);
            })
            ->get();
    
        return view('admin\horario\index', compact('horarios', 'docentes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.horario.create', [
            'docentes' => Docente::all(),
            'unidades' => UnidadCurricular::all(),
            'periodos' => PeriodoAcademico::all(),
            'secciones' => Seccion::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'unidad_curricular_id' => 'required|exists:unidad_curricular,id',
            'periodo_academico_id' => 'required|exists:periodo_academico,id',
            'dia' => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_finalizacion' => 'required|date_format:H:i|after:hora_inicio',
            'seccion_id' => 'required|exists:seccions,id',
        ]);

        $dia = $validated['dia'];
        $inicio = $validated['hora_inicio'];
        $fin = $validated['hora_finalizacion'];
        $docenteId = $validated['docente_id'];
        $seccionId = $validated['seccion_id'];

        // Validación 1: El docente no debe tener conflictos de horario el mismo día
        $conflictoDocente = Horario::where('docente_id', $docenteId)
            ->whereDate('dia', $dia)
            ->where(function ($query) use ($inicio, $fin) {
                $query->whereBetween('hora_inicio', [$inicio, $fin])
                    ->orWhereBetween('hora_finalizacion', [$inicio, $fin])
                    ->orWhere(function ($q) use ($inicio, $fin) {
                        $q->where('hora_inicio', '<=', $inicio)
                        ->where('hora_finalizacion', '>=', $fin);
                    });
            })->exists();

        if ($conflictoDocente) {
            return back()->withErrors(['conflicto' => 'El docente ya tiene un horario en ese rango de tiempo.'])->withInput();
        }

        // Validación 2: En la misma sección, no debe haber otra materia a la misma hora ese día
        $conflictoSeccion = Horario::where('seccion_id', $seccionId)
            ->whereDate('dia', $dia)
            ->where(function ($query) use ($inicio, $fin) {
                $query->whereBetween('hora_inicio', [$inicio, $fin])
                    ->orWhereBetween('hora_finalizacion', [$inicio, $fin])
                    ->orWhere(function ($q) use ($inicio, $fin) {
                        $q->where('hora_inicio', '<=', $inicio)
                        ->where('hora_finalizacion', '>=', $fin);
                    });
            })->exists();

        if ($conflictoSeccion) {
            return back()->withErrors(['conflicto' => 'Ya existe un horario para esa sección que se cruza con este.'])->withInput();
        }

        Horario::create($validated);

        return redirect()->route('admin.horario.index')->with('message', 'Horario registrado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $horario = Horario::with(['docente', 'unidadCurricular', 'periodoAcademico'])->findOrFail($id);
        return view('admin.horario.show', compact('horario'));
    }

    public function edit(Horario $horario)
    {
        $docentes = Docente::all();
        $unidades = UnidadCurricular::all();
        $periodos = PeriodoAcademico::all();
        $secciones = Seccion::all();

        return view('admin.horario.edit', compact('horario', 'docentes', 'unidades', 'periodos', 'secciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $horario = Horario::findOrFail($id);

        $validated = $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'unidad_curricular_id' => 'required|exists:unidad_curricular,id',
            'periodo_academico_id' => 'required|exists:periodo_academico,id',
            'dia' => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_finalizacion' => 'required|date_format:H:i|after:hora_inicio',
            'seccion_id' => 'required|exists:seccions,id',
        ]);

        // Validar conflictos de horarios para el docente (excluyendo el actual)
        $conflictoDocente = Horario::where('id', '!=', $horario->id)
            ->where('docente_id', $validated['docente_id'])
            ->whereDate('dia', $validated['dia'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('hora_inicio', [$validated['hora_inicio'], $validated['hora_finalizacion']])
                    ->orWhereBetween('hora_finalizacion', [$validated['hora_inicio'], $validated['hora_finalizacion']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('hora_inicio', '<', $validated['hora_inicio'])
                            ->where('hora_finalizacion', '>', $validated['hora_finalizacion']);
                    });
            })->exists();

        if ($conflictoDocente) {
            return back()->withErrors(['error' => 'Este docente ya tiene un horario en conflicto este día.']);
        }

        // Validar conflicto en la misma sección
        $conflictoSeccion = Horario::where('id', '!=', $horario->id)
            ->where('seccion_id', $validated['seccion_id'])
            ->whereDate('dia', $validated['dia'])
            ->where(function ($query) use ($validated) {
                $query->whereBetween('hora_inicio', [$validated['hora_inicio'], $validated['hora_finalizacion']])
                    ->orWhereBetween('hora_finalizacion', [$validated['hora_inicio'], $validated['hora_finalizacion']])
                    ->orWhere(function ($q) use ($validated) {
                        $q->where('hora_inicio', '<', $validated['hora_inicio'])
                            ->where('hora_finalizacion', '>', $validated['hora_finalizacion']);
                    });
            })->exists();

        if ($conflictoSeccion) {
            return back()->withErrors(['error' => 'Ya existe un horario para esta sección en el mismo día y horario.']);
        }

        $horario->update($validated);

        return redirect()->route('admin.horario.index')->with('message', 'Horario actualizado correctamente');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $horario = Horario::findOrFail($id);
        $horario->delete();

        return redirect()->route('admin.horario.index')->with('message', 'Horario eliminado correctamente');
    }


}
