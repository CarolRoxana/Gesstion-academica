<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Docente;
use App\Models\UnidadCurricular;
use App\Models\PeriodoAcademico;
use App\Models\Seccion;
use App\Helpers\ArrayHelper;
use Carbon\Carbon;

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

        $sedes = ArrayHelper::sedes();
        return view('admin.horario.create', [
            'docentes' => Docente::all(),
            'unidades' => UnidadCurricular::all(),
            'periodos' => PeriodoAcademico::all(),
            'secciones' => Seccion::all(),
            'sedes' => $sedes,
            "bloques" => ArrayHelper::bloques(),

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
            'hora_inicio' => 'required',
            'hora_finalizacion' => 'required',
            'seccion_id' => 'required|exists:seccions,id',
            "sede" => 'required',
            "aula_id" => 'required',
        ]);


        //dd($request->all());

        $dia = $validated['dia'];
        $inicio = Carbon::parse($validated['hora_inicio'])->format('H:i:s');
        $fin = Carbon::parse($validated['hora_finalizacion'])->format('H:i:s');
        $docenteId = $validated['docente_id'];
        $seccionId = $validated['seccion_id'];
        $sede = $validated['sede'];
        $aulaId = $validated['aula_id'];

        // Validación 1: El docente no debe tener conflictos de horario el mismo día con el periodo académico

        $conflictoDocente = Horario::where('docente_id', $docenteId)
            ->where('dia', $dia)
            ->where('periodo_academico_id', $validated['periodo_academico_id'])
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

        // Validación 2: En la misma sección, no debe haber otra materia a la misma hora ese día en el periodo academico
        $conflictoSeccion = Horario::where('seccion_id', $seccionId)
            ->where('dia', $dia)
            ->where('periodo_academico_id', $validated['periodo_academico_id'])
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

        // Validación 3: En la misma sede, no debe haber otra aula ocupada a la misma hora ese día en ese periodo academico
        $conflictoSede = Horario::where('sede', $sede)
            ->where('aula_id', $aulaId)
            ->where('dia', $dia)
            ->where('periodo_academico_id', $validated['periodo_academico_id'])
            ->where(function ($query) use ($inicio, $fin) {
                $query->whereBetween('hora_inicio', [$inicio, $fin])
                    ->orWhereBetween('hora_finalizacion', [$inicio, $fin])
                    ->orWhere(function ($q) use ($inicio, $fin) {
                        $q->where('hora_inicio', '<=', $inicio)
                            ->where('hora_finalizacion', '>=', $fin);
                    });
            })->exists();
        if ($conflictoSede) {
            return back()->withErrors(['conflicto' => 'Ya existe un horario para esa aula que se cruza con este.'])->withInput();
        }

        $horario = new Horario();
        $horario->docente_id = $validated['docente_id'];
        $horario->unidad_curricular_id = $validated['unidad_curricular_id'];
        $horario->periodo_academico_id = $validated['periodo_academico_id'];
        $horario->dia = $validated['dia'];
        $horario->hora_inicio = $inicio;
        $horario->hora_finalizacion = $fin;
        $horario->seccion_id = $validated['seccion_id'];
        $horario->sede = $validated['sede'];
        $horario->aula_id = $validated['aula_id'];
        $horario->save();
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
        $bloques = ArrayHelper::bloques();
        $sedes = ArrayHelper::sedes();
        $aulas = ArrayHelper::aulasPorSede($horario->sede);

        return view('admin.horario.edit', compact(
            "bloques",
            'horario',
            'docentes',
            'unidades',
            'periodos',
            'secciones',
            'sedes',
            'aulas'
            
        ));
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
            'hora_inicio' => 'required',
            'hora_finalizacion' => 'required',
            'seccion_id' => 'required|exists:seccions,id',
            "sede" => 'required',
            "aula_id" => 'required',
        ]);

        $inicio = Carbon::parse($validated['hora_inicio'])->format('H:i:s');
        $fin = Carbon::parse($validated['hora_finalizacion'])->format('H:i:s');

        


        // Validar conflictos de horarios para el docente (excluyendo el actual)
        $conflictoDocente = Horario::where('docente_id', $validated['docente_id'])
            ->where('id', '!=', $horario->id)
            ->where('dia', $validated['dia'])
            ->where('periodo_academico_id', $validated['periodo_academico_id'])
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

        // Validar conflicto en la misma sección
        $conflictoSeccion = Horario::where('seccion_id', $validated['seccion_id'])
            ->where('id', '!=', $horario->id)
            ->where('dia', $validated['dia'])
            ->where('periodo_academico_id', $validated['periodo_academico_id'])
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

        // Validar conflicto en la misma sede
        $conflictoSede = Horario::where('sede', $validated['sede'])
            ->where('aula_id', $validated['aula_id'])
            ->where('id', '!=', $horario->id)
            ->where('dia', $validated['dia'])
            ->where('periodo_academico_id', $validated['periodo_academico_id'])
            ->where(function ($query) use ($inicio, $fin) {
                $query->whereBetween('hora_inicio', [$inicio, $fin])
                    ->orWhereBetween('hora_finalizacion', [$inicio, $fin])
                    ->orWhere(function ($q) use ($inicio, $fin) {
                        $q->where('hora_inicio', '<=', $inicio)
                            ->where('hora_finalizacion', '>=', $fin);
                    });
            })->exists();
        if ($conflictoSede) {
            return back()->withErrors(['conflicto' => 'Ya existe un horario para esa aula que se cruza con este.'])->withInput();
        }
        

        // Actualizar el horario
        $horario->docente_id = $validated['docente_id'];
        $horario->unidad_curricular_id = $validated['unidad_curricular_id'];
        $horario->periodo_academico_id = $validated['periodo_academico_id'];
        $horario->dia = $validated['dia'];
        $horario->hora_inicio = $inicio;
        $horario->hora_finalizacion = $fin;
        $horario->seccion_id = $validated['seccion_id'];
        $horario->sede = $validated['sede'];
        $horario->aula_id = $validated['aula_id'];
        $horario->save();


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
    public function aulasPorSede($sede)
    {

        $items = ArrayHelper::aulasPorSede($sede);

        return response()->json($items);
    }
}
