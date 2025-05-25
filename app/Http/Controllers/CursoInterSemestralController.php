<?php

namespace App\Http\Controllers;

use App\Models\CursoInterSemestral;
use App\Models\Docente;
use Illuminate\Http\Request;

class CursoInterSemestralController extends Controller
{
    public function index()
    {
        $cursos = CursoInterSemestral::with('docente')->latest()->get();
        return view('admin\curso_inter_semestral\index', compact('cursos'));
    }

    public function create()
    {
        $docentes = Docente::all();
        return view('admin\curso_inter_semestral\create', compact('docentes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'nombre_curso' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'modalidad' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'cupos_max' => 'required|integer|min:1',
            'estatus' => 'required|string',
            'exponente' => 'nullable|string',
        ]);

        CursoInterSemestral::create($request->all());

        return redirect()->route('admin.curso-inter-semestral.index')->with('success', 'Curso creado exitosamente.');
    }

    public function edit(CursoInterSemestral $curso_inter_semestral)
    {
        $docentes = Docente::all();
        return view('admin.curso_inter_semestral.edit', compact('curso_inter_semestral', 'docentes'));
    }

    public function show(CursoInterSemestral $curso_inter_semestral)
    {
        return view('admin\curso_inter_semestral\show', [
            'curso' => $curso_inter_semestral
        ]);
    }

    public function update(Request $request, CursoInterSemestral $curso_inter_semestral)
    {
        $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'nombre_curso' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'modalidad' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'cupos_max' => 'required|integer|min:1',
            'estatus' => 'required|string',
            'exponente' => 'nullable|string',
        ]);

        $curso_inter_semestral->update($request->all());

        return redirect()->route('admin.curso-inter-semestral.index')->with('success', 'Curso actualizado exitosamente.');
    }

    public function destroy(CursoInterSemestral $curso_inter_semestral)
    {
      try {
            $curso_inter_semestral->delete();
            return redirect()->route('admin.curso-inter-semestral.index')->with('success', 'Curso eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.curso-inter-semestral.index')->with('error', 'Error al eliminar el curso. Asegúrese de que no esté asociado a otros registros.');
        }
    }
}
