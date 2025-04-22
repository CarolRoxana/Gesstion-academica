<?php

namespace App\Http\Controllers;

use App\Models\PropuestaTg;
use Illuminate\Http\Request;

class PropuestaTgController extends Controller
{
    public function index()
    {
        $propuestas = PropuestaTg::all();
        return view('admin.propuesta_tg.index', compact('propuestas'));
    }

    public function create()
    {
        return view('admin.propuesta_tg.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_entrega' => 'required|date',
            'propuesta' => 'required|file|mimes:pdf|max:10240', // Validación para el archivo PDF
        ]);

        $propuestaPath = $request->file('propuesta')->store('propuestas', 'public'); // Guardamos el archivo PDF

        PropuestaTg::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_entrega' => $request->fecha_entrega,
            'propuesta' => $propuestaPath, // Guardamos la ruta del archivo
        ]);

        return redirect()->route('admin.propuesta_tg.index')->with('success', 'Propuesta TG guardada con éxito.');
    }

    public function edit($id)
    {
        $propuesta = PropuestaTg::findOrFail($id);
        return view('propuesta_tg.edit', compact('propuesta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_entrega' => 'required|date',
            'propuesta' => 'nullable|file|mimes:pdf|max:10240', // Validación para el archivo PDF
        ]);

        $propuesta = PropuestaTg::findOrFail($id);

        // Si se sube un nuevo archivo
        if ($request->hasFile('propuesta')) {
            $propuestaPath = $request->file('propuesta')->store('propuestas', 'public');
            $propuesta->propuesta = $propuestaPath;
        }

        $propuesta->update($request->all());

        return redirect()->route('admin.propuesta_tg.index')->with('success', 'Propuesta TG actualizada con éxito.');
    }

    public function destroy($id)
    {
        $propuesta = PropuestaTg::findOrFail($id);
        
        // Eliminar el archivo de la carpeta 'propuestas' si existe
        // \Storage::disk('public')->delete($propuesta->propuesta);
        
        $propuesta->delete();

        return redirect()->route('admin.propuesta_tg.index')->with('success', 'Propuesta TG eliminada con éxito.');
    }
}
