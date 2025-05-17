<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\PropuestaTp;
use App\Models\UnidadCurricular;
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
        $docentes = Docente::all();
        $carreras = UnidadCurricular::select('carrera')->distinct()->pluck('carrera');
        return view('admin.propuesta_tp.create', compact('docentes', 'carreras'));
    }
    public function show($id)
    {
        $propuesta = PropuestaTp::findOrFail($id);
        return view('admin.propuesta_tp.show', compact('propuesta'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_pasante' => 'required|string|max:255',
            'apellido_pasante' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'carrera' => 'required|string|max:100',
            'titulo_propuesta' => 'required|string|max:255',
            'plan_trabajo' => 'required|file|mimes:pdf|max:10240',
            'docente_id' => 'required|exists:docentes,id',
            'estatus' => 'required|string|in:proceso,pendiente,aprobada,rechazada',
            'fecha_ingreso' => 'required|date',
        ]);

        $plan_trabajoPath = $request->file('plan_trabajo')->store('propuestas', 'public'); 

        PropuestaTp::create([
           'nombre_pasante' => $request->nombre_pasante,
            'apellido_pasante' => $request->apellido_pasante,
            'cedula' => $request->cedula,
            'carrera' => $request->carrera,
            'titulo_propuesta' => $request->titulo_propuesta,
            'plan_trabajo' => $plan_trabajoPath,
            'docente_id' => $request->docente_id,
            'estatus' => $request->estatus,
            'fecha_ingreso' => $request->fecha_ingreso,
        ]);

        return redirect()->route('admin.propuesta_tp.index')->with('success', 'Propuesta TP guardada con éxito.');
    }

    public function edit($id)
    {
        
        $propuesta = PropuestaTp::findOrFail($id);
        $docentes = Docente::all();
        $carreras = UnidadCurricular::select('carrera')->distinct()->pluck('carrera');
        
        return view('admin.propuesta_tp.edit', compact('propuesta', 'docentes', 'carreras'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
             'nombre_pasante' => 'required|string|max:255',
            'apellido_pasante' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'carrera' => 'required|string|max:100',
            'titulo_propuesta' => 'required|string|max:255',
            'plan_trabajo' => 'required|file|mimes:pdf|max:10240',
            'docente_id' => 'required|exists:docentes,id',
            'estatus' => 'required|string|in:proceso,pendiente,aprobada,rechazada',
            'fecha_ingreso' => 'required|date',
        ]);

        $plan_trabajo = PropuestaTp::findOrFail($id);

        if ($request->hasFile('plan_trabajo')) {
            $plan_trabajoPath = $request->file('plan_trabajo')->store('propuestas', 'public');
            $plan_trabajo->propuesta = $plan_trabajoPath;
        }

        $plan_trabajo->update($request->all());

        return redirect()->route('admin.propuesta_tp.index')->with('success', 'Propuesta TP actualizada con éxito.');
    }

    public function destroy($id)
    {
        $propuesta = PropuestaTp::findOrFail($id);
        
        $propuesta->delete();

        return redirect()->route('admin.propuesta_tp.index')->with('success', 'Propuesta TP eliminada con éxito.');
    }
}
