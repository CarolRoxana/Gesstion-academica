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
        return view('admin.periodoAcademico.create');
    }

    public function store(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // Crear el nuevo periodo académico con los campos validados
        $periodo = new PeriodoAcademico();
        $periodo->periodo = $request->nombre;
        $periodo->fecha_inicio = $request->fecha_inicio;
        $periodo->fecha_finalizacion = $request->fecha_fin;
        $periodo->save();

        // Redirigir con mensaje de éxito
        return redirect()->route('admin.periodo-academico.index')->with('success', 'Periodo académico creado con éxito.');
    }

    public function show(PeriodoAcademico $periodo_academico)
    {
        return view('admin\periodoAcademico\show', compact('periodo_academico'));
    }

    public function edit($periodo_academico)
    {

        $periodo_academico = PeriodoAcademico::find($periodo_academico);
        return view('admin.periodoAcademico.edit', compact('periodo_academico'));
    }

    public function update(Request $request,  $periodo_academico)
    {

        //dd($request->all(), $periodo_academico);


        // Actualizar el periodo académico con los campos validados
        $data = PeriodoAcademico::find($periodo_academico);
        $data->periodo = $request->periodo;
        $data->fecha_inicio = $request->fecha_inicio;
        $data->fecha_finalizacion = $request->fecha_finalizacion;


        $data->save();


        return redirect()->route('admin.periodo-academico.index')->with('success', 'Periodo académico actualizado.');
    }

    public function destroy(PeriodoAcademico $periodo_academico)
    {


        try {
            $periodo_academico->delete();
            return redirect()->route('admin.periodo-academico.index')->with('success', 'Periodo académico eliminado.');
        } catch (\Exception $e) {
            return redirect()->route('admin.periodo-academico.index')->with('error', 'No se puede eliminar el periodo académico porque está en uso.');
        }
    }
}
