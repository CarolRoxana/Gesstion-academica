<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Docente;
use App\Models\UnidadCurricular;
use App\Models\PeriodoAcademico;
use App\Models\Seccion;
use App\Helpers\ArrayHelper;
use App\Models\UnidadCurricularPeriodoAcademico;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        $periodos  = PeriodoAcademico::all();

        return view('admin\horario\index', compact('horarios', 'docentes', "periodos"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $sedes = ArrayHelper::sedes();
        $modulos  = ArrayHelper::$modulos;
        $pisos = ArrayHelper::$pisos;

        return view('admin.horario.create', [
            'docentes' => Docente::all(),

            'periodos' => PeriodoAcademico::all(),
            'secciones' => Seccion::all(),
            'sedes' => $sedes,
            "bloques" => ArrayHelper::bloques(),
            'modulos' => $modulos,
            'pisos' => $pisos,


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
            'seccion_id' => 'required',
            "sede" => 'required',
            "aula_id" => 'required',

        ]);


        //dd($request->all());

        $seccion = Seccion::find($validated['seccion_id']);
        $seccionId = $seccion->nombre;

        $dia = $validated['dia'];
        $inicio = Carbon::parse($validated['hora_inicio'])->format('H:i:s');
        $fin = Carbon::parse($validated['hora_finalizacion'])->format('H:i:s');
        $docenteId = $validated['docente_id'];
        $sede = $validated['sede'];
        $aulaId = $validated['aula_id'];

        //dd($sede, $aulaId, $inicio, $fin, $dia, $docenteId, $seccionId, $request->all());
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
            return back()->withErrors([
                'conflicto' => "El docente ya tiene un horario en ese rango de tiempo ({$validated['hora_inicio']} - {$validated['hora_finalizacion']})."
            ])->withInput();
        }

        // Validación 2: En la misma sección, no debe haber otra materia a la misma hora ese día en el periodo academico y debes tener en cuenta el semestre


        $conflictoSeccion = DB::table('horarios')
            ->join('unidad_curricular', 'horarios.unidad_curricular_id', '=', 'unidad_curricular.id')
            ->join('seccions', 'horarios.seccion_id', '=', 'seccions.id')
            ->join('docentes', 'horarios.docente_id', '=', 'docentes.id')
            ->where('seccions.nombre', $seccionId)
            ->where('horarios.dia', $dia)
            ->where('horarios.periodo_academico_id', $validated['periodo_academico_id'])
            ->where(function ($query) use ($inicio, $fin) {
                $query->whereBetween('horarios.hora_inicio', [$inicio, $fin])
                    ->orWhereBetween('horarios.hora_finalizacion', [$inicio, $fin])
                    ->orWhere(function ($q) use ($inicio, $fin) {
                        $q->where('horarios.hora_inicio', '<=', $inicio)
                            ->where('horarios.hora_finalizacion', '>=', $fin);
                    });
            })
            ->select(
                'horarios.*',
                "unidad_curricular.semestre as semestre",
                'unidad_curricular.nombre as unidad_nombre',
                'seccions.nombre as seccion_nombre',
                "docentes.*",
            )
            ->first();

        //dd($conflictoSeccion);


        if ($conflictoSeccion) {
            $mensaje = "<div style='padding: 8px 0; background:#d9534f; color:#fff; border-radius:4px;'>";
            $mensaje .= "<div style='font-weight:bold; margin-bottom:6px;'>Ya existe un horario para la sección que se cruza con este:</div>";
            $mensaje .= "<div style='display: flex; flex-direction: column; gap: 4px;'>";
            $mensaje .= "<span><strong>Semestre:</strong> {$conflictoSeccion->semestre}</span>";
            $mensaje .= "<span><strong>Sección:</strong> {$conflictoSeccion->seccion_nombre}</span>";
            $mensaje .= "<span><strong>Unidad Curricular:</strong> {$conflictoSeccion->unidad_nombre}</span>";
            $mensaje .= "<span><strong>Docente:</strong> {$conflictoSeccion->nombre} {$conflictoSeccion->apellido}</span>";
            $mensaje .= "<span><strong>Horario:</strong> {$validated['hora_inicio']} - {$validated['hora_finalizacion']}</span>";
            $mensaje .= "</div></div>";
            return back()->withErrors(['conflicto' => $mensaje])->withInput();
        }

        // Validación 3: En la misma sede, no debe haber otra aula ocupada a la misma hora ese día en ese periodo academico

        $conflictoSede = Horario::where('sede', $sede)
            ->where('aula_id', $aulaId)
            ->where('dia', $dia)
            ->where('modulo', $request['modulo'])
            ->where('piso', $request['piso'])
            ->where('periodo_academico_id', $validated['periodo_academico_id'])
            ->where(function ($query) use ($inicio, $fin) {
                $query->whereBetween('hora_inicio', [$inicio, $fin])
                    ->orWhereBetween('hora_finalizacion', [$inicio, $fin])
                    ->orWhere(function ($q) use ($inicio, $fin) {
                        $q->where('hora_inicio', '<=', $inicio)
                            ->where('hora_finalizacion', '>=', $fin);
                    });
            })
            ->with(['docente',])
            ->first();

        if ($conflictoSede) {
            $mensaje = "<div style='padding: 8px 0; background:#d9534f; color:#fff; border-radius:4px;'>";
            $mensaje .= "<div style='font-weight:bold; margin-bottom:6px;'>Ya existe un horario para esa aula que se cruza con este:</div>";
            $mensaje .= "<div style='display: flex; flex-direction: column; gap: 4px;'>";
            $mensaje .= "<span><strong>Docente:</strong> {$conflictoSede->docente->nombre} {$conflictoSede->docente->apellido}</span>";
            $mensaje .= "<span><strong>Aula:</strong> {$conflictoSede->aula_id}</span>";
            $mensaje .= "<span><strong>Módulo:</strong> {$conflictoSede->modulo}</span>";
            $mensaje .= "<span><strong>Piso:</strong> {$conflictoSede->piso}</span>";
            $mensaje .= "<span><strong>Horario:</strong> {$validated['hora_inicio']} - {$validated['hora_finalizacion']}</span>";
            $mensaje .= "</div></div>";
            return back()->withErrors(['conflicto' => $mensaje])->withInput();
        }

        //dd("hola");
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
        $horario->modulo = $request['modulo'];
        $horario->piso = $request['piso'];


        //dd($horario);
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

        $periodos = PeriodoAcademico::all();
        $secciones = Seccion::all();
        $bloques = ArrayHelper::bloques();
        $sedes = ArrayHelper::sedes();
        $aulas = ArrayHelper::aulasPorSede($horario->sede);
        $modulos  = ArrayHelper::$modulos;
        $pisos = ArrayHelper::$pisos;

        $unidades = UnidadCurricularPeriodoAcademico::where(
            'periodo_academico_id',
            $horario->periodo_academico_id
        )
            ->with('unidadCurricular')
            ->get()
            ->map(
                function ($item) {
                    return [
                        'id' => $item->unidadCurricular->id,
                        'nombre' => $item->unidadCurricular->nombre,
                    ];
                }
            );


        return view('admin.horario.edit', compact(
            "bloques",
            'horario',
            'docentes',
            "unidades",
            'periodos',
            'secciones',
            'sedes',
            'aulas',
            'modulos',
            'pisos'

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
            'seccion_id' => 'required',
            "sede" => 'required',
            "aula_id" => 'required',

        ]);

        $seccion = Seccion::find($validated['seccion_id']);
        $seccionId = $seccion->nombre;
        $inicio = Carbon::parse($validated['hora_inicio'])->format('H:i:s');
        $fin = Carbon::parse($validated['hora_finalizacion'])->format('H:i:s');


        $dia = $validated['dia'];
        $docenteId = $validated['docente_id'];
        $sede = $validated['sede'];
        $aulaId = $validated['aula_id'];





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
        $conflictoSeccion = DB::table('horarios')
            ->join('unidad_curricular', 'horarios.unidad_curricular_id', '=', 'unidad_curricular.id')
            ->join('seccions', 'horarios.seccion_id', '=', 'seccions.id')
            ->join('docentes', 'horarios.docente_id', '=', 'docentes.id')
            ->where('seccions.nombre', $seccionId)
            ->where('horarios.id', '!=', $horario->id)
            ->where('horarios.dia',  $validated['dia'])
            ->where('horarios.periodo_academico_id', $validated['periodo_academico_id'])
            ->where(function ($query) use ($inicio, $fin) {
                $query->whereBetween('horarios.hora_inicio', [$inicio, $fin])
                    ->orWhereBetween('horarios.hora_finalizacion', [$inicio, $fin])
                    ->orWhere(function ($q) use ($inicio, $fin) {
                        $q->where('horarios.hora_inicio', '<=', $inicio)
                            ->where('horarios.hora_finalizacion', '>=', $fin);
                    });
            })
            ->select('horarios.*', 
            "unidad_curricular.semestre as semestre",
            'unidad_curricular.nombre as unidad_nombre', 'seccions.nombre as seccion_nombre', "docentes.*",)
            ->first();

        // dd($conflictoSeccion);


        if ($conflictoSeccion) {
            $mensaje = "<div style='padding: 8px 0; background:#d9534f; color:#fff; border-radius:4px;'>";
            $mensaje .= "<div style='font-weight:bold; margin-bottom:6px;'>Ya existe un horario para la sección que se cruza con este:</div>";
            $mensaje .= "<div style='display: flex; flex-direction: column; gap: 4px;'>";
            $mensaje .= "<span><strong>Semestre:</strong> {$conflictoSeccion->semestre}</span>";
            $mensaje .= "<span><strong>Sección:</strong> {$conflictoSeccion->seccion_nombre}</span>";
            $mensaje .= "<span><strong>Unidad Curricular:</strong> {$conflictoSeccion->unidad_nombre}</span>";
            $mensaje .= "<span><strong>Docente:</strong> {$conflictoSeccion->nombre} {$conflictoSeccion->apellido}</span>";
            $mensaje .= "<span><strong>Horario:</strong> {$validated['hora_inicio']} - {$validated['hora_finalizacion']}</span>";
            $mensaje .= "</div></div>";
            return back()->withErrors(['conflicto' => $mensaje])->withInput();
        }


        $conflictoSede = Horario::where('sede', $sede)
            ->where('id', '!=', $horario->id)
            ->where('aula_id', $aulaId)
            ->where('dia', $dia)
            ->where('modulo', $request['modulo'])
            ->where('piso', $request['piso'])
            ->where('periodo_academico_id', $validated['periodo_academico_id'])
            ->where(function ($query) use ($inicio, $fin) {
                $query->whereBetween('hora_inicio', [$inicio, $fin])
                    ->orWhereBetween('hora_finalizacion', [$inicio, $fin])
                    ->orWhere(function ($q) use ($inicio, $fin) {
                        $q->where('hora_inicio', '<=', $inicio)
                            ->where('hora_finalizacion', '>=', $fin);
                    });
            })
            ->with(['docente',])
            ->first();

        if ($conflictoSede) {
            $mensaje = "<div style='padding: 8px 0; background:#d9534f; color:#fff; border-radius:4px;'>";
            $mensaje .= "<div style='font-weight:bold; margin-bottom:6px;'>Ya existe un horario para esa aula que se cruza con este:</div>";
            $mensaje .= "<div style='display: flex; flex-direction: column; gap: 4px;'>";
            $mensaje .= "<span><strong>Docente:</strong> {$conflictoSede->docente->nombre} {$conflictoSede->docente->apellido}</span>";
            $mensaje .= "<span><strong>Aula:</strong> {$conflictoSede->aula_id}</span>";
            $mensaje .= "<span><strong>Módulo:</strong> {$conflictoSede->modulo}</span>";
            $mensaje .= "<span><strong>Piso:</strong> {$conflictoSede->piso}</span>";
            $mensaje .= "<span><strong>Horario:</strong> {$validated['hora_inicio']} - {$validated['hora_finalizacion']}</span>";
            $mensaje .= "</div></div>";
            return back()->withErrors(['conflicto' => $mensaje])->withInput();
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
        $horario->modulo = $request['modulo'];
        $horario->piso = $request['piso'];
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


    public function unidadesCurriculares($periodo)
    {

        $items = UnidadCurricularPeriodoAcademico::where(
            'periodo_academico_id',
            $periodo
        )
            ->with('unidadCurricular')
            ->get()
            ->map(
                function ($item) {
                    return [
                        'id' => $item->unidadCurricular->id,
                        'nombre' => $item->unidadCurricular->nombre,
                        "modalidad" => $item->modalidad,
                    ];
                }
            );

        return response()->json($items);
    }
}
