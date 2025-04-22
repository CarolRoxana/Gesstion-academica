<?php

namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
use App\Models\UnidadCurricular;
use App\Models\Docente;
use Illuminate\Http\Request;

class UnidadCurricularController extends Controller
{
    public function index()
    {
        $unidades = UnidadCurricular::with('docente')->get();
        return view('admin\unidadCurricular\index', compact('unidades'));
    }

    public function create()
    {
        $docentes = Docente::all();
        return view('admin\unidadCurricular\create', compact('docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'nombre' => 'required|string|max:255',
            'unidad_curricular' => 'required|integer',
            'carrera' => 'required|string|max:255',
            'semestre' => 'required|string|max:100',
        ]);

        UnidadCurricular::create($request->all());

        return redirect()->route('admin\unidadCurricular\index')
                         ->with('success', 'Unidad Curricular creada correctamente.');
    }

    public function show(UnidadCurricular $unidad_curricular)
    {
        return view('admin\unidadCurricular\show', compact('unidad_curricular'));
    }

    public function edit(UnidadCurricular $unidad_curricular)
    {
        $docentes = Docente::all();
        return view('admin\unidadCurricular\edit', compact('unidadCurricular', 'docentes'));
    }

    public function update(Request $request, UnidadCurricular $unidad_curricular)
    {
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'nombre' => 'required|string|max:255',
            'unidad_curricular' => 'required|integer',
            'carrera' => 'required|string|max:255',
            'semestre' => 'required|string|max:100',
        ]);

        $unidad_curricular->update($request->all());

        return redirect()->route('admin\unidadCurricular\index')
                         ->with('success', 'Unidad Curricular actualizada correctamente.');
    }

    public function destroy(UnidadCurricular $unidad_curricular)
    {
        $unidad_curricular->delete();

        return redirect()->route('admin\unidadCurricular\index')
                         ->with('success', 'Unidad Curricular eliminada correctamente.');
    }
}
