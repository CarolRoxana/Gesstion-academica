<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\UnidadCurricular;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        return view('admin.docente.index', compact('docentes'));
    }

    public function create()
    {
        return view('admin.docente.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:docentes',
            'correo' => 'required|email|unique:docentes',
            'telefono' => 'nullable|string|max:20',
        ]);

        $docente = new Docente($request->all());
        $docente->rol_id = 3; // ID del rol "user"
        $docente->save();

        return redirect()->route('admin.docente.index')->with('success', 'Docente creado correctamente.');
    }

    public function show(Docente $docente)
    {
        return view('admin.docente.show', compact('docente'));
    }

    public function edit(Docente $docente)
    {
        return view('admin.docente.editt', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:docentes,cedula,' . $docente->id,
            'correo' => 'required|email|unique:docentes,correo,' . $docente->id,
            'telefono' => 'nullable|string|max:20',
        ]);

        $docente->fill($request->all());
        $docente->rol_id = 3; // Mantener rol "user"
        $docente->save();

        return redirect()->route('admin.docente.index')->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return redirect()->route('admin.docente.index')->with('success', 'Docente eliminado correctamente.');
    }
}
