<?php

namespace App\Http\Controllers;

use App\Models\LineamientoDocente;
use App\Models\Docente;
use App\Models\PeriodoAcademico;
use Illuminate\Http\Request;

class LineamientoDocenteController extends Controller
{
    public function index()
    {
        $lineamientos = LineamientoDocente::with(['docente', 'periodoAcademico'])->get();
        return view('admin.lineamiento_docente.index', compact('lineamientos'));
    }

    public function create()
    {
        $docentes = Docente::all();
        $periodos = PeriodoAcademico::all();
        return view('admin.lineamiento_docente.create', compact('docentes', 'periodos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'fecha_supervision' => 'required|date',
            'resumen' => 'required|string|max:255',
            'cumple_lineamientos' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
            'periodo_academico_id' => 'required|exists:periodo_academico,id',
        ]);

        LineamientoDocente::create($request->all());

        return redirect()->route('admin.lineamiento_docente.index')->with('success', 'Lineamiento docente creado correctamente.');
    }

    // Método para mostrar el formulario de edición
    public function edit(LineamientoDocente $lineamientoDocente)
    {
        $docentes = Docente::all();
        $periodos = PeriodoAcademico::all();
        return view('admin.lineamiento_docente.edit', compact('lineamientoDocente', 'docentes', 'periodos'));
    }

    // Método para actualizar un lineamiento
    public function update(Request $request, LineamientoDocente $lineamientoDocente)
    {
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'fecha_supervision' => 'required|date',
            'resumen' => 'required|string|max:255',
            'cumple_lineamientos' => 'required|string|max:255',
            'observaciones' => 'nullable|string',
            'periodo_academico_id' => 'required|exists:periodo_academico,id',
        ]);

        $lineamientoDocente->update($request->all());

        return redirect()->route('admin.lineamiento_docente.index')->with('success', 'Lineamiento docente actualizado correctamente.');
    }

    // Método para eliminar un lineamiento
    public function destroy(LineamientoDocente $lineamientoDocente)
    {
        $lineamientoDocente->delete();
        return redirect()->route('admin.lineamiento_docente.index')->with('success', 'Lineamiento docente eliminado correctamente.');
    }
}
