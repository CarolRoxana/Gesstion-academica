<?php

namespace App\Http\Controllers;

use App\Models\PropuestaTp;
use Illuminate\Http\Request;

class PropuestaTpController extends Controller
{
    public function index()
    {
        $propuestas = PropuestaTp::all();
        return view('admin.propuesta_tp.index', compact('propuestas'));
    }

    public function create()
    {
        return view('admin.propuesta_tp.create');
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

        PropuestaTp::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_entrega' => $request->fecha_entrega,
            'propuesta' => $propuestaPath, // Guardamos la ruta del archivo
        ]);

        return redirect()->route('admin.propuesta_tp.index')->with('success', 'Propuesta TP guardada con éxito.');
    }

    public function edit($id)
    {
        $propuesta = PropuestaTp::findOrFail($id);
        return view('admin.propuesta_tp.edit', compact('propuesta'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'fecha_entrega' => 'required|date',
            'propuesta' => 'nullable|file|mimes:pdf|max:10240', // Validación para el archivo PDF
        ]);

        $propuesta = PropuestaTp::findOrFail($id);

        // Si se sube un nuevo archivo
        if ($request->hasFile('propuesta')) {
            $propuestaPath = $request->file('propuesta')->store('propuestas', 'public');
            $propuesta->propuesta = $propuestaPath;
        }

        $propuesta->update($request->all());

        return redirect()->route('admin.propuesta_tp.index')->with('success', 'Propuesta TP actualizada con éxito.');
    }

    public function destroy($id)
    {
        $propuesta = PropuestaTp::findOrFail($id);
        
        // Eliminar el archivo de la carpeta 'propuestas' si existe
        // \Storage::disk('public')->delete($propuesta->propuesta);
        
        $propuesta->delete();

        return redirect()->route('admin.propuesta_tp.index')->with('success', 'Propuesta TP eliminada con éxito.');
    }
}
