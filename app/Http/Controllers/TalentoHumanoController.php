<?php

namespace App\Http\Controllers;

use App\Models\TalentoHumano;
use Illuminate\Http\Request;

class TalentoHumanoController extends Controller
{
    public function index()
    {
        $talentoHumano = TalentoHumano::all();
        return view('admin.talento_humano.index', compact('talentoHumano'));
    }

    public function create()
    {
        return view('admin.talento_humano.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:talento_humano',
            'correo' => 'required|email|unique:talento_humano',
            'telefono' => 'nullable|string|max:15',
            'fecha_postulacion' => 'required|date',
            'motivo' => 'required|string',
            'carrera_postulacion' => 'required|string',
            'unidad_curricular_postulacion' => 'required|string',
            'estatus' => 'required|string',
            'observaciones' => 'nullable|string',
            'fecha_aprobacion' => 'nullable|date',
            'fecha_ingreso' => 'nullable|date',
        ]);

        TalentoHumano::create($request->all());

        return redirect()->route('admin.talento_humano.index')->with('success', 'Talento Humano creado con éxito.');
    }

    public function edit($id)
    {
        $talentoHumano = TalentoHumano::findOrFail($id);
        return view('admin.talento_humano.edit', compact('talentoHumano'));
    }

    public function show($id)
    {
        $talentoHumano = TalentoHumano::findOrFail($id);
        return view('admin.talento_humano.show', compact('talentoHumano'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:talento_humano,cedula,' . $id,
            'correo' => 'required|email|unique:talento_humano,correo,' . $id,
            'telefono' => 'nullable|string|max:15',
            'fecha_postulacion' => 'required|date',
            'motivo' => 'required|string',
            'carrera_postulacion' => 'required|string',
            'unidad_curricular_postulacion' => 'required|string',
            'estatus' => 'required|string',
            'observaciones' => 'nullable|string',
            'fecha_aprobacion' => 'nullable|date',
            'fecha_ingreso' => 'nullable|date',
        ]);

        $talentoHumano = TalentoHumano::findOrFail($id);
        $talentoHumano->update($request->all());

        return redirect()->route('admin.talento_humano.index')->with('success', 'Talento Humano actualizado con éxito.');
    }

    public function destroy($id)
    {
        $talentoHumano = TalentoHumano::findOrFail($id);
        $talentoHumano->delete();

        return redirect()->route('admin.talento_humano.index')->with('success', 'Talento Humano eliminado con éxito.');
    }
}
