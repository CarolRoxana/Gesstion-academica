<?php

namespace App\Http\Controllers;

use App\Models\LicenciaDocente;
use App\Models\User;
use Illuminate\Http\Request;

class LicenciaDocenteController extends Controller
{
    public function index()
    {
        $licencias = LicenciaDocente::with('user')->get();
        return view('licencia_docentes.index', compact('licencias'));
    }

    public function create()
    {
        $users = \App\Models\User::all();
        return view('licencia_docentes.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nombre_curso' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'tipo_curso' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estatus' => 'required|string|max:50',
        ]);

        LicenciaDocente::create($request->all());

        return redirect()->route('licencia_docentes.index')->with('success', 'Licencia creada con éxito.');
    }

    public function show(LicenciaDocente $licencia_docente)
    {
        return view('licencia_docentes.show', compact('licencia_docente'));
    }

    public function edit(LicenciaDocente $licencia_docente)
    {
        $users = \App\Models\User::all();
        return view('licencia_docentes.edit', compact('licencia_docente', 'users'));
    }

    public function update(Request $request, LicenciaDocente $licencia_docente)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'nombre_curso' => 'required|string|max:255',
            'institucion' => 'required|string|max:255',
            'tipo_curso' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'estatus' => 'required|string|max:50',
        ]);

        $licencia_docente->update($request->all());

        return redirect()->route('licencia_docentes.index')->with('success', 'Licencia actualizada con éxito.');
    }

    public function destroy(LicenciaDocente $licencia_docente)
    {
        try {
            $licencia_docente->delete();
            return redirect()->route('licencia_docentes.index')->with('success', 'Licencia eliminada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('licencia_docentes.index')->with('error', 'Error al eliminar la licencia: ' . $e->getMessage());
        }
    }
}
