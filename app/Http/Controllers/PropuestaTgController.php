<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
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
        $carreras = ArrayHelper::carreras();
        return view('admin.propuesta_tg.create', compact('docentes', 'carreras'));
    }
    
    public function show($id)
    {
        $propuesta = PropuestaTg::findOrFail($id);
        return view('admin.propuesta_tg.show', compact('propuesta'));
    }

    public function store(Request $request)
    {
        $validationRules = [
            'nombre_tesista' => 'required|string|max:255',
            'apellido_tesista' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'carrera' => 'required|string|max:100',
            'titulo_propuesta' => 'required|string|max:255',
            'propuesta' => 'required|file|mimes:pdf|max:10240',
            'docente_id' => 'required|exists:docentes,id',
            'estatus' => 'required|string|in:proceso,pendiente,aprobada,rechazada',
            'fecha_ingreso' => 'required|date',
            
            // Campos opcionales para tesista 2
            'nombre_tesista2' => 'nullable|string|max:255',
            'apellido_tesista2' => 'nullable|string|max:255',
            'cedula2' => 'nullable|string|max:20',
            'carrera2' => 'nullable|string|max:100',
            
            // Campos opcionales para tesista 3
            'nombre_tesista3' => 'nullable|string|max:255',
            'apellido_tesista3' => 'nullable|string|max:255',
            'cedula3' => 'nullable|string|max:20',
            'carrera3' => 'nullable|string|max:100',
        ];
        
        // Validación adicional para asegurar que los datos del tesista 2 y 3 sean completos si se proporciona algún campo
        if ($request->filled('nombre_tesista2') || $request->filled('apellido_tesista2') || 
            $request->filled('cedula2') || $request->filled('carrera2')) {
            $validationRules['nombre_tesista2'] = 'required|string|max:255';
            $validationRules['apellido_tesista2'] = 'required|string|max:255';
            $validationRules['cedula2'] = 'required|string|max:20';
            $validationRules['carrera2'] = 'required|string|max:100';
        }
        
        if ($request->filled('nombre_tesista3') || $request->filled('apellido_tesista3') || 
            $request->filled('cedula3') || $request->filled('carrera3')) {
            $validationRules['nombre_tesista3'] = 'required|string|max:255';
            $validationRules['apellido_tesista3'] = 'required|string|max:255';
            $validationRules['cedula3'] = 'required|string|max:20';
            $validationRules['carrera3'] = 'required|string|max:100';
        }

        $request->validate($validationRules);

        $propuestaPath = $request->file('propuesta')->store('propuestas', 'public');

        $propuestaData = [
            'nombre_tesista' => $request->nombre_tesista,
            'apellido_tesista' => $request->apellido_tesista,
            'cedula' => $request->cedula,
            'carrera' => $request->carrera,
            'titulo_propuesta' => $request->titulo_propuesta,
            'propuesta' => $propuestaPath,
            'docente_id' => $request->docente_id,
            'estatus' => $request->estatus,
            'fecha_ingreso' => $request->fecha_ingreso,
        ];
        
        // Agregar datos del tesista 2 si existen
        if ($request->filled('nombre_tesista2')) {
            $propuestaData['nombre_tesista2'] = $request->nombre_tesista2;
            $propuestaData['apellido_tesista2'] = $request->apellido_tesista2;
            $propuestaData['cedula2'] = $request->cedula2;
            $propuestaData['carrera2'] = $request->carrera2;
        }
        
        // Agregar datos del tesista 3 si existen
        if ($request->filled('nombre_tesista3')) {
            $propuestaData['nombre_tesista3'] = $request->nombre_tesista3;
            $propuestaData['apellido_tesista3'] = $request->apellido_tesista3;
            $propuestaData['cedula3'] = $request->cedula3;
            $propuestaData['carrera3'] = $request->carrera3;
        }

        PropuestaTg::create($propuestaData);

        return redirect()->route('admin.propuesta_tg.index')->with('success', 'Propuesta TG guardada con éxito.');
    }

    public function edit($id)
    {
        
        $propuesta = PropuestaTg::findOrFail($id);
        $docentes = Docente::all();
        $carreras = ArrayHelper::carreras();
        
        return view('admin.propuesta_tg.edit', compact('propuesta', 'docentes', 'carreras'));
    }

    public function update(Request $request, $id)
    {
        $validationRules = [
            'nombre_tesista' => 'required|string|max:255',
            'apellido_tesista' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'carrera' => 'required|string|max:100',
            'titulo_propuesta' => 'required|string|max:255',
            'propuesta' => 'nullable|file|mimes:pdf|max:10240',
            'docente_id' => 'required|exists:docentes,id',
            'estatus' => 'required|string|in:proceso,pendiente,aprobada,rechazada',
            'fecha_ingreso' => 'required|date',
            
            // Campos opcionales para tesista 2
            'nombre_tesista2' => 'nullable|string|max:255',
            'apellido_tesista2' => 'nullable|string|max:255',
            'cedula2' => 'nullable|string|max:20',
            'carrera2' => 'nullable|string|max:100',
            
            // Campos opcionales para tesista 3
            'nombre_tesista3' => 'nullable|string|max:255',
            'apellido_tesista3' => 'nullable|string|max:255',
            'cedula3' => 'nullable|string|max:20',
            'carrera3' => 'nullable|string|max:100',
        ];
        
        // Validación adicional para asegurar que los datos del tesista 2 y 3 sean completos si se proporciona algún campo
        if ($request->filled('nombre_tesista2') || $request->filled('apellido_tesista2') || 
            $request->filled('cedula2') || $request->filled('carrera2')) {
            $validationRules['nombre_tesista2'] = 'required|string|max:255';
            $validationRules['apellido_tesista2'] = 'required|string|max:255';
            $validationRules['cedula2'] = 'required|string|max:20';
            $validationRules['carrera2'] = 'required|string|max:100';
        }
        
        if ($request->filled('nombre_tesista3') || $request->filled('apellido_tesista3') || 
            $request->filled('cedula3') || $request->filled('carrera3')) {
            $validationRules['nombre_tesista3'] = 'required|string|max:255';
            $validationRules['apellido_tesista3'] = 'required|string|max:255';
            $validationRules['cedula3'] = 'required|string|max:20';
            $validationRules['carrera3'] = 'required|string|max:100';
        }

        $request->validate($validationRules);

        $propuesta = PropuestaTg::findOrFail($id);
        
        // Procesar el archivo de propuesta si se proporciona uno nuevo
        if ($request->hasFile('propuesta')) {
            $propuestaPath = $request->file('propuesta')->store('propuestas', 'public');
            $propuesta->propuesta = $propuestaPath;
        }
        
        // Actualizar los campos del primer tesista (siempre requeridos)
        $propuesta->nombre_tesista = $request->nombre_tesista;
        $propuesta->apellido_tesista = $request->apellido_tesista;
        $propuesta->cedula = $request->cedula;
        $propuesta->carrera = $request->carrera;
        
        // Actualizar los campos del segundo tesista (opcionales)
        $propuesta->nombre_tesista2 = $request->nombre_tesista2;
        $propuesta->apellido_tesista2 = $request->apellido_tesista2;
        $propuesta->cedula2 = $request->cedula2;
        $propuesta->carrera2 = $request->carrera2;
        
        // Actualizar los campos del tercer tesista (opcionales)
        $propuesta->nombre_tesista3 = $request->nombre_tesista3;
        $propuesta->apellido_tesista3 = $request->apellido_tesista3;
        $propuesta->cedula3 = $request->cedula3;
        $propuesta->carrera3 = $request->carrera3;
        
        // Actualizar los otros campos
        $propuesta->titulo_propuesta = $request->titulo_propuesta;
        $propuesta->docente_id = $request->docente_id;
        $propuesta->estatus = $request->estatus;
        $propuesta->fecha_ingreso = $request->fecha_ingreso;
        
        $propuesta->save();

        return redirect()->route('admin.propuesta_tg.index')->with('success', 'Propuesta TG actualizada con éxito.');
    }

    public function destroy($id)
    {
        try {
            $propuesta = PropuestaTg::findOrFail($id);
            $propuesta->delete();
            return redirect()->route('admin.propuesta_tg.index')->with('success', 'Propuesta TG eliminada con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.propuesta_tg.index')->with('error', 'Error al eliminar la propuesta TG.');
        }
    }
}