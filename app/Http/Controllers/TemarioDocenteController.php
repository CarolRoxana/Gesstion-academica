<?php

namespace App\Http\Controllers;

use App\Models\TemarioDocente;
use App\Models\UnidadCurricularPeriodoAcademico;
use Illuminate\Http\Request;

class TemarioDocenteController extends Controller
{
    public function index()
    {
        $temarios = TemarioDocente::all();
        return view('admin.temario_docente.index', compact('temarios'));
    }

    public function create()
    {
        $unidadCurricularPeriodoAcademico = UnidadCurricularPeriodoAcademico::all();
        return view('admin.temario_docente.create', compact('unidadCurricularPeriodoAcademico'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unidad_curricular_periodo_academico_id' => 'required|exists:unidad_curricular_periodo_academico,id',
            'contenido' => 'required|file|mimes:pdf|max:10240', // Solo PDF y tamaño máximo de 10MB
            'fecha_agregado' => 'required|date',
        ]);

        TemarioDocente::create($request->all());
        return redirect()->route('admin.temario_docente.index')->with('success', 'Temario agregado con éxito.');
    }

    public function edit($id)
    {
        $temario = TemarioDocente::findOrFail($id);
        $unidadCurricularPeriodoAcademico = UnidadCurricularPeriodoAcademico::all();
        return view('admin.temario_docente.edit', compact('temario', 'unidadCurricularPeriodoAcademico'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unidad_curricular_periodo_academico_id' => 'required|exists:unidad_curricular_periodo_academico,id',
            'contenido' => 'nullable|file|mimes:pdf|max:10240', // Solo PDF y tamaño máximo de 10MB
            'fecha_agregado' => 'required|date',
        ]);

        $temario = TemarioDocente::findOrFail($id);

        if ($request->hasFile('contenido')) {
            $file = $request->file('contenido');
            $temario->contenido = $file->store('temarios', 'public');
        }

        $temario->update($request->all());
        return redirect()->route('admin.temario_docente.index')->with('success', 'Temario actualizado con éxito.');
    }

    public function destroy($id)
    {
        try {
            $temario = TemarioDocente::findOrFail($id);
            $temario->delete();
            return redirect()->route('admin.temario_docente.index')->with('success', 'Temario eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.temario_docente.index')->with('error', 'Error al eliminar el temario.');
        }
   
    }
}
