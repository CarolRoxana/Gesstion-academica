<?php

namespace App\Http\Controllers;

use App\Models\PeriodoAcademico;
use Illuminate\Http\Request;

class PeriodoAcademicoController extends Controller
{
    public function index()
    {
        $periodos = PeriodoAcademico::all();
        return view('admin\periodoAcademico\index', compact('periodos'));
    }

    public function create()
    {
        return view('admin\periodoAcademico\create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'periodo' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);
    
        // Crear el nuevo periodo académico con los campos validados
        PeriodoAcademico::create($request->only(['periodo', 'fecha_inicio', 'fecha_fin']));
    
        // Redirigir con mensaje de éxito
        return redirect()->route('admin.periodo-academico.index')->with('success', 'Periodo académico creado con éxito.');
    }

    public function show(PeriodoAcademico $periodo_academico)
    {
        return view('admin\periodoAcademico\show', compact('periodo_academico'));
    }

    public function edit(PeriodoAcademico $periodo_academico)
    {
        return view('admin\periodoAcademico\edit', compact('periodo_academico'));
    }

    public function update(Request $request, PeriodoAcademico $periodo_academico)
    {
        $request->validate([
            'periodo' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $periodo_academico->update($request->all());

        return redirect()->route('admin.periodo-academico.index')->with('success', 'Periodo académico actualizado.');
    }

    public function destroy(PeriodoAcademico $periodo_academico)
    {
        $periodo_academico->delete();
        return redirect()->route('admin.periodo-academico.index')->with('success', 'Periodo académico eliminado.');
    }
}