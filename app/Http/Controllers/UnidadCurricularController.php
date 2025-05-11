<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use App\Models\UnidadCurricular;
use App\Models\Docente;
use App\Models\PeriodoAcademico;
use App\Models\Seccion;
use Illuminate\Http\Request;

class UnidadCurricularController extends Controller
{
    public function index()
    {
        $unidades = UnidadCurricular::with('secciones')->get();
        return view('admin\unidadCurricular\index', compact('unidades'));
    }

    public function create()
    {
        $carreras = UnidadCurricular::select('carrera')->distinct()->pluck('carrera');
        $periodos = PeriodoAcademico::all();
    
        return view('admin.unidadCurricular.create', compact('carreras', 'periodos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_curricular' => 'required|integer',
            'carrera' => 'required|string|max:255',
            'semestre' => 'required|string|max:100',
            'secciones' => 'required|array|min:1',
            'secciones.*' => 'required|string|max:50',
        ]);

        $unidad = UnidadCurricular::create($request->only([
            'nombre', 'unidad_curricular', 'carrera', 'semestre'
        ]));

        foreach ($request->secciones as $seccionNombre) {
            Seccion::create([
                'nombre' => $seccionNombre,
                'unidad_curricular_id' => $unidad->id,
            ]);
        }

        return redirect()->route('admin.unidad-curricular.index')
                         ->with('success', 'Unidad Curricular y secciones creadas correctamente.');
    }

    public function getSecciones($id)
    {
        $secciones = Seccion::where('unidad_curricular_id', $id)->get();
        return response()->json($secciones);
    }

    public function show(UnidadCurricular $unidad_curricular)
    {
        $unidad_curricular->load('secciones');

        return view('admin\unidadCurricular\show', compact('unidad_curricular'));
    }

    public function edit(UnidadCurricular $unidad_curricular)
    {
        $carreras = UnidadCurricular::select('carrera')->distinct()->pluck('carrera');
        $periodos = PeriodoAcademico::all();

        return view('admin\unidadCurricular\edit', compact('unidad_curricular', 'carreras', 'periodos'));
    }

    public function update(Request $request, UnidadCurricular $unidad_curricular)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'unidad_curricular' => 'required|integer',
            'carrera' => 'required|string|max:255',
            'semestre' => 'required|string|max:100',
        ]);

        $unidad_curricular->update($request->only([
            'nombre', 'unidad_curricular', 'carrera', 'semestre'
        ]));

        return redirect()->route('admin.unidad-curricular.index')
                         ->with('success', 'Unidad Curricular actualizada correctamente.');
    }

    public function destroy(UnidadCurricular $unidad_curricular)
    {
        if ($unidad_curricular->horarios()->exists()) {
            return back()->withErrors(['error' => 'No se puede eliminar la unidad curricular porque tiene horarios asociados.']);
        }
    
        $unidad_curricular->delete();
    
        return redirect()->route('admin.unidad-curricular.index')
                         ->with('success', 'Unidad Curricular eliminada correctamente.');
    }
}