<?php

namespace App\Http\Controllers;

use App\Models\IncidenteEstudiantil;
use App\Models\Docente;
use Illuminate\Http\Request;

class IncidenteEstudiantilController extends Controller
{
    public function index()
    {
        $incidentes = IncidenteEstudiantil::with('docente')->latest()->paginate(10);
        return view('admin\incidente_estudiantiles\index', compact('incidentes'));
    }

    public function create()
    {
        $docentes = Docente::all();
        return view('admin\incidente_estudiantiles\create', compact('docentes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            'semestre' => 'required|string|max:255',
            'incidente' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_incidente' => 'required|date',
        ]);

        IncidenteEstudiantil::create($data);

        return redirect()->route('admin\incidente_estudiantiles\index')->with('success', 'Incidente registrado correctamente');
    }

    public function show(IncidenteEstudiantil $incidente_estudiantil)
    {
        return view('admin\incidente_estudiantiles\show', compact('incidente_estudiantil'));
    }

    public function edit(IncidenteEstudiantil $incidente_estudiantil)
    {
        $docentes = Docente::all();
        return view('admin\incidente_estudiantiles\edit', compact('incidente_estudiantil', 'docentes'));
    }

    public function update(Request $request, IncidenteEstudiantil $incidente_estudiantil)
    {
        $data = $request->validate([
            'docente_id' => 'required|exists:docentes,id',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            'semestre' => 'required|string|max:255',
            'incidente' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_incidente' => 'required|date',
        ]);

        $incidente_estudiantil->update($data);

        return redirect()->route('admin\incidente_estudiantiles\index')->with('success', 'Incidente actualizado correctamente');
    }

    public function destroy(IncidenteEstudiantil $incidente_estudiantil)
    {
        $incidente_estudiantil->delete();

        return redirect()->route('admin\incidente_estudiantiles\index')->with('success', 'Incidente eliminado');
    }
}