<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\PropuestaTg;
use App\Models\UnidadCurricular;
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
        $docentes = Docente::all();
        $carreras = UnidadCurricular::select('carrera')->distinct()->pluck('carrera');
        return view('admin.propuesta_tg.create', compact('docentes', 'carreras'));
    }
        public function show($id)
    {
        $propuesta = PropuestaTg::findOrFail($id);
        return view('admin.propuesta_tg.show', compact('propuesta'));
    }

    public function store(Request $request)
    {
        $request->validate([
        'nombre_tesista' => 'required|string|max:255',
        'apellido_tesista' => 'required|string|max:255',
        'cedula' => 'required|string|max:20',
        'carrera' => 'required|string|max:100',
        'titulo_propuesta' => 'required|string|max:255',
        'propuesta' => 'required|file|mimes:pdf|max:10240',
        'docente_id' => 'required|exists:docentes,id',
        'estatus' => 'required|string|in:proceso,pendiente,aprobada,rechazada',
        'fecha_ingreso' => 'required|date',
    ]);

        $propuestaPath = $request->file('propuesta')->store('propuestas', 'public');

        PropuestaTg::create([
            'nombre_tesista' => $request->nombre_tesista,
            'apellido_tesista' => $request->apellido_tesista,
            'cedula' => $request->cedula,
            'carrera' => $request->carrera,
            'titulo_propuesta' => $request->titulo_propuesta,
            'propuesta' => $propuestaPath,
            'docente_id' => $request->docente_id,
            'estatus' => $request->estatus,
            'fecha_ingreso' => $request->fecha_ingreso,
        ]);

        return redirect()->route('admin.propuesta_tg.index')->with('success', 'Propuesta TG guardada con éxito.');
        dd('llegó al método store');
    }

    public function edit($id)
    {
        $propuesta = PropuestaTg::findOrFail($id);
        $docentes = Docente::all();
        $carreras = UnidadCurricular::select('carrera')->distinct()->pluck('carrera');
        
        return view('admin.propuesta_tg.edit', compact('propuesta', 'docentes', 'carreras'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
           'nombre_tesista' => 'required|string|max:255',
            'apellido_tesista' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'carrera' => 'required|string|max:100',
            'titulo_propuesta' => 'required|string|max:255',
            'propuesta' => 'required|file|mimes:pdf|max:10240',
            'docente_id' => 'required|exists:docentes,id',
           'estatus' => 'required|string|in:proceso,pendiente,aprobada,rechazada',
            'fecha_ingreso' => 'required|date',
        ]);

        $propuesta = PropuestaTg::findOrFail($id);

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
        
        $propuesta->delete();

        return redirect()->route('admin.propuesta_tg.index')->with('success', 'Propuesta TG eliminada con éxito.');
    }
}