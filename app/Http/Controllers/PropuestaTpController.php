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
        $validationRules = [
            'nombre_pasante' => 'required|string|max:255',
            'apellido_pasante' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'carrera' => 'required|string|max:100',
            'titulo_propuesta' => 'required|string|max:255',
            'plan_trabajo' => 'required|file|mimes:pdf|max:10240',
            'docente_id' => 'required|exists:docentes,id',
            'estatus' => 'required|string|in:proceso,pendiente,aprobada,rechazada',
            'fecha_ingreso' => 'required|date',

            // Campos opcionales para pasante 2
            'nombre_pasante2' => 'nullable|string|max:255',
            'apellido_pasante2' => 'nullable|string|max:255',
            'cedula2' => 'nullable|string|max:20',
            'carrera2' => 'nullable|string|max:100',
            
            // Campos opcionales para pasante 3
            'nombre_pasante3' => 'nullable|string|max:255',
            'apellido_pasante3' => 'nullable|string|max:255',
            'cedula3' => 'nullable|string|max:20',
            'carrera3' => 'nullable|string|max:100',
        ];

        if ($request->filled('nombre_pasante2') || $request->filled('apellido_pasante2') || 
            $request->filled('cedula2') || $request->filled('carrera2')) {
            $validationRules['nombre_pasante2'] = 'required|string|max:255';
            $validationRules['apellido_pasante2'] = 'required|string|max:255';
            $validationRules['cedula2'] = 'required|string|max:20';
            $validationRules['carrera2'] = 'required|string|max:100';
        }
        
        if ($request->filled('nombre_pasante3') || $request->filled('apellido_pasante3') || 
            $request->filled('cedula3') || $request->filled('carrera3')) {
            $validationRules['nombre_pasante3'] = 'required|string|max:255';
            $validationRules['apellido_pasante3'] = 'required|string|max:255';
            $validationRules['cedula3'] = 'required|string|max:20';
            $validationRules['carrera3'] = 'required|string|max:100';
        }

        $request->validate($validationRules);

        $plan_trabajoPath = $request->file('plan_trabajo')->store('propuestas', 'public'); 

        $propuestaData = [
            'nombre_pasante' => $request->nombre_pasante,
            'apellido_pasante' => $request->apellido_pasante,
            'cedula' => $request->cedula,
            'carrera' => $request->carrera,
            'titulo_propuesta' => $request->titulo_propuesta,
            'plan_trabajo' => $plan_trabajoPath,
            'docente_id' => $request->docente_id,
            'estatus' => $request->estatus,
            'fecha_ingreso' => $request->fecha_ingreso,
        ];
        
        // Agregar datos del tesista 2 si existen
        if ($request->filled('nombre_pasante2')) {
            $propuestaData['nombre_pasante2'] = $request->nombre_pasante2;
            $propuestaData['apellido_pasante2'] = $request->apellido_pasante2;
            $propuestaData['cedula2'] = $request->cedula2;
            $propuestaData['carrera2'] = $request->carrera2;
        }
        
        // Agregar datos del tesista 3 si existen
        if ($request->filled('nombre_pasante3')) {
            $propuestaData['nombre_pasante3'] = $request->nombre_pasante3;
            $propuestaData['apellido_pasante3'] = $request->apellido_pasante3;
            $propuestaData['cedula3'] = $request->cedula3;
            $propuestaData['carrera3'] = $request->carrera3;
        }

        PropuestaTp::create($propuestaData);

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
        $validationRules = [
            'nombre_pasante' => 'required|string|max:255',
            'apellido_pasante' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'carrera' => 'required|string|max:100',
            'titulo_propuesta' => 'required|string|max:255',
            'plan_trabajo' => 'required|file|mimes:pdf|max:10240',
            'docente_id' => 'required|exists:docentes,id',
            'estatus' => 'required|string|in:proceso,pendiente,aprobada,rechazada',
            'fecha_ingreso' => 'required|date',

            // Campos opcionales para pasante 2
            'nombre_pasante2' => 'nullable|string|max:255',
            'apellido_pasante2' => 'nullable|string|max:255',
            'cedula2' => 'nullable|string|max:20',
            'carrera2' => 'nullable|string|max:100',
            
            // Campos opcionales para pasante 3
            'nombre_pasante3' => 'nullable|string|max:255',
            'apellido_pasante3' => 'nullable|string|max:255',
            'cedula3' => 'nullable|string|max:20',
            'carrera3' => 'nullable|string|max:100',
        ];

        if ($request->filled('nombre_pasante2') || $request->filled('apellido_pasante2') || 
            $request->filled('cedula2') || $request->filled('carrera2')) {
            $validationRules['nombre_pasante2'] = 'required|string|max:255';
            $validationRules['apellido_pasante2'] = 'required|string|max:255';
            $validationRules['cedula2'] = 'required|string|max:20';
            $validationRules['carrera2'] = 'required|string|max:100';
        }
        
        if ($request->filled('nombre_pasante3') || $request->filled('apellido_pasante3') || 
            $request->filled('cedula3') || $request->filled('carrera3')) {
            $validationRules['nombre_pasante3'] = 'required|string|max:255';
            $validationRules['apellido_pasante3'] = 'required|string|max:255';
            $validationRules['cedula3'] = 'required|string|max:20';
            $validationRules['carrera3'] = 'required|string|max:100';
        }

        $request->validate($validationRules);

        $plan_trabajo = PropuestaTp::findOrFail($id);

        if ($request->hasFile('plan_trabajo')) {
        $validated['plan_trabajo'] = $request->file('plan_trabajo')
                                            ->store('propuestas', 'public');
        } else {
            unset($validated['plan_trabajo']); // no tocarlo si no llega
        }

        $plan_trabajo->update($validated);

        // Actualizar los campos del primer pasante (siempre requeridos)
        $plan_trabajo->nombre_pasante = $request->nombre_pasante;
        $plan_trabajo->apellido_pasante = $request->apellido_pasante;
        $plan_trabajo->cedula = $request->cedula;
        $plan_trabajo->carrera = $request->carrera;
        
        // Actualizar los campos del segundo pasante (opcionales)
        $plan_trabajo->nombre_pasante2 = $request->nombre_pasante2;
        $plan_trabajo->apellido_pasante2 = $request->apellido_pasante2;
        $plan_trabajo->cedula2 = $request->cedula2;
        $plan_trabajo->carrera2 = $request->carrera2;
        
        // Actualizar los campos del tercer pasante (opcionales)
        $plan_trabajo->nombre_pasante3 = $request->nombre_pasante3;
        $plan_trabajo->apellido_pasante3 = $request->apellido_pasante3;
        $plan_trabajo->cedula3 = $request->cedula3;
        $plan_trabajo->carrera3 = $request->carrera3;
        
        // Actualizar los otros campos
        $plan_trabajo->plan_trabajo = $request->plan_trabajo;
        $plan_trabajo->docente_id = $request->docente_id;
        $plan_trabajo->estatus = $request->estatus;
        $plan_trabajo->fecha_ingreso = $request->fecha_ingreso;

        $plan_trabajo->update($request->all());

        return redirect()->route('admin.propuesta_tp.index')->with('success', 'Propuesta TP actualizada con éxito.');
    }

    public function destroy($id)
    {
        try {
            $propuesta = PropuestaTp::findOrFail($id);
            $propuesta->delete();
            return redirect()->route('admin.propuesta_tp.index')->with('success', 'Propuesta TP eliminada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.propuesta_tp.index')->with('error', 'Error al eliminar la propuesta TP.');
        }
    
    }
}
