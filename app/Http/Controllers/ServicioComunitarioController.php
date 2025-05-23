<?php


namespace App\Http\Controllers;

use App\Helpers\ArrayHelper;
use App\Models\ServicioComunitario;
use App\Models\Docente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicioComunitarioController extends Controller
{
    public function index()
    {
        $servicios = ServicioComunitario::latest()->paginate(10);
        return view('admin.servicio_comunitario.index', compact('servicios'));
    }

    public function show(ServicioComunitario $servicio)
    {
        return view('admin.servicio_comunitario.show', compact('servicio'));
    }

    public function create()
    {
        $docentes = Docente::all();
        $carreras = ArrayHelper::carreras();
        return view('admin.servicio_comunitario.create', compact('docentes', 'carreras'));
    }

    public function store(Request $request)
{
    $validationRules = [
        // Primer estudiante (requerido)
        'nombre_estudiante' => 'required|string|max:255',
        'apellido_estudiante' => 'required|string|max:255',
        'cedula' => 'required|string|max:255',
        'carrera' => 'required|string|max:255',

        // Segundo estudiante (opcionales)
        'nombre_estudiante2' => 'nullable|string|max:255',
        'apellido_estudiante2' => 'nullable|string|max:255',
        'cedula2' => 'nullable|string|max:255',
        'carrera2' => 'nullable|string|max:255',

        // Tercer estudiante (opcionales)
        'nombre_estudiante3' => 'nullable|string|max:255',
        'apellido_estudiante3' => 'nullable|string|max:255',
        'cedula3' => 'nullable|string|max:255',
        'carrera3' => 'nullable|string|max:255',

        // Cuarto estudiante (opcionales)
        'nombre_estudiante4' => 'nullable|string|max:255',
        'apellido_estudiante4' => 'nullable|string|max:255',
        'cedula4' => 'nullable|string|max:255',
        'carrera4' => 'nullable|string|max:255',

        // Quinto estudiante (opcionales)
        'nombre_estudiante5' => 'nullable|string|max:255',
        'apellido_estudiante5' => 'nullable|string|max:255',
        'cedula5' => 'nullable|string|max:255',
        'carrera5' => 'nullable|string|max:255',

        'titulo_servicio' => 'required|string|max:255',
        'trabajo_servicio' => 'required|file|mimes:pdf|max:10240',
        'docente_id' => 'required|exists:docentes,id',
        'estatus' => 'required|string|in:proceso,pendiente,aprobada,rechazada',
        'fecha_ingreso' => 'required|date',
    ];

    // Validación adicional para estudiante 2
    if ($request->filled('nombre_estudiante2') || $request->filled('apellido_estudiante2') ||
        $request->filled('cedula2') || $request->filled('carrera2')) {
        $validationRules['nombre_estudiante2'] = 'required|string|max:255';
        $validationRules['apellido_estudiante2'] = 'required|string|max:255';
        $validationRules['cedula2'] = 'required|string|max:255';
        $validationRules['carrera2'] = 'required|string|max:255';
    }
    // Validación adicional para estudiante 3
    if ($request->filled('nombre_estudiante3') || $request->filled('apellido_estudiante3') ||
        $request->filled('cedula3') || $request->filled('carrera3')) {
        $validationRules['nombre_estudiante3'] = 'required|string|max:255';
        $validationRules['apellido_estudiante3'] = 'required|string|max:255';
        $validationRules['cedula3'] = 'required|string|max:255';
        $validationRules['carrera3'] = 'required|string|max:255';
    }
    // Validación adicional para estudiante 4
    if ($request->filled('nombre_estudiante4') || $request->filled('apellido_estudiante4') ||
        $request->filled('cedula4') || $request->filled('carrera4')) {
        $validationRules['nombre_estudiante4'] = 'required|string|max:255';
        $validationRules['apellido_estudiante4'] = 'required|string|max:255';
        $validationRules['cedula4'] = 'required|string|max:255';
        $validationRules['carrera4'] = 'required|string|max:255';
    }
    // Validación adicional para estudiante 5
    if ($request->filled('nombre_estudiante5') || $request->filled('apellido_estudiante5') ||
        $request->filled('cedula5') || $request->filled('carrera5')) {
        $validationRules['nombre_estudiante5'] = 'required|string|max:255';
        $validationRules['apellido_estudiante5'] = 'required|string|max:255';
        $validationRules['cedula5'] = 'required|string|max:255';
        $validationRules['carrera5'] = 'required|string|max:255';
    }

    $request->validate($validationRules);

    $servicioPath = $request->file('trabajo_servicio')->store('servicios', 'public');

      $servicioData = [
            'nombre_estudiante' => $request->nombre_estudiante,
            'apellido_estudiante' => $request->apellido_estudiante,
            'cedula' => $request->cedula,
            'carrera' => $request->carrera,
            
            'titulo_servicio' => $request->titulo_servicio,
            'trabajo_servicio' => $servicioPath,
            'docente_id' => $request->docente_id,
            'estatus' => $request->estatus,
            'fecha_ingreso' => $request->fecha_ingreso,
        ];

        // Agregar datos si existe estudiante 2
    if ($request->filled('nombre_estudiante2')) {
        $servicioData['nombre_estudiante2'] = $request->nombre_estudiante2;
        $servicioData['apellido_estudiante2'] =$request->apellido_tesista2;
        $servicioData['cedula2'] = $request->cedula2;
        $servicioData['carrera2'] = $request->carrera2;
    }
        // Agregar datos si existe estudiante 3
    if ($request->filled('nombre_estudiante3')) {
        $servicioData['nombre_estudiante3'] = $request->nombre_estudiante3;
        $servicioData['apellido_estudiante3'] =$request->apellido_tesista3;
        $servicioData['cedula3'] = $request->cedula3;
        $servicioData['carrera3'] = $request->carrera3;
    }
        // Agregar datos si existe estudiante 4
    if ($request->filled('nombre_estudiante4')) {
        $servicioData['nombre_estudiante4'] = $request->nombre_estudiante4;
        $servicioData['apellido_estudiante4'] =$request->apellido_tesista4;
        $servicioData['cedula4'] = $request->cedula4;
        $servicioData['carrera4'] = $request->carrera4;
    }
        // Agregar datos si existe estudiante 5
    if ($request->filled('nombre_estudiante5')) {
        $servicioData['nombre_estudiante5'] = $request->nombre_estudiante5;
        $servicioData['apellido_estudiante5'] =$request->apellido_tesista5;
        $servicioData['cedula5'] = $request->cedula5;
        $servicioData['carrera5'] = $request->carrera5;
    }

    ServicioComunitario::create($servicioData);

    return redirect()->route('admin.servicio_comunitario.index')->with('success', 'Servicio comunitario registrado con éxito.');
}
    public function edit(ServicioComunitario $servicio)
    {
        $docentes = Docente::all();
        $carreras = ArrayHelper::carreras();
        return view('admin.servicio_comunitario.edit', compact('servicio', 'docentes', 'carreras'));
    }

    public function update(Request $request, ServicioComunitario $servicio)
{
    $validationRules = [
        'nombre_estudiante' => 'required|string|max:255',
        'apellido_estudiante' => 'required|string|max:255',
        'cedula' => 'required|string|max:255',
        'carrera' => 'required|string|max:255',

        'nombre_estudiante2' => 'nullable|string|max:255',
        'apellido_estudiante2' => 'nullable|string|max:255',
        'cedula2' => 'nullable|string|max:255',
        'carrera2' => 'nullable|string|max:255',

        'nombre_estudiante3' => 'nullable|string|max:255',
        'apellido_estudiante3' => 'nullable|string|max:255',
        'cedula3' => 'nullable|string|max:255',
        'carrera3' => 'nullable|string|max:255',

        'nombre_estudiante4' => 'nullable|string|max:255',
        'apellido_estudiante4' => 'nullable|string|max:255',
        'cedula4' => 'nullable|string|max:255',
        'carrera4' => 'nullable|string|max:255',

        'nombre_estudiante5' => 'nullable|string|max:255',
        'apellido_estudiante5' => 'nullable|string|max:255',
        'cedula5' => 'nullable|string|max:255',
        'carrera5' => 'nullable|string|max:255',

        'titulo_servicio' => 'required|string|max:255',
        'trabajo_servicio' => 'nullable|file|mimes:pdf|max:10240',
        'docente_id' => 'required|exists:docentes,id',
        'estatus' => 'required|string|in:proceso,pendiente,aprobada,rechazada',
        'fecha_ingreso' => 'required|date',
    ];

    if ($request->filled('nombre_estudiante2') || $request->filled('apellido_estudiante2') ||
        $request->filled('cedula2') || $request->filled('carrera2')) {
        $validationRules['nombre_estudiante2'] = 'required|string|max:255';
        $validationRules['apellido_estudiante2'] = 'required|string|max:255';
        $validationRules['cedula2'] = 'required|string|max:255';
        $validationRules['carrera2'] = 'required|string|max:255';
    }
    if ($request->filled('nombre_estudiante3') || $request->filled('apellido_estudiante3') ||
        $request->filled('cedula3') || $request->filled('carrera3')) {
        $validationRules['nombre_estudiante3'] = 'required|string|max:255';
        $validationRules['apellido_estudiante3'] = 'required|string|max:255';
        $validationRules['cedula3'] = 'required|string|max:255';
        $validationRules['carrera3'] = 'required|string|max:255';
    }
    if ($request->filled('nombre_estudiante4') || $request->filled('apellido_estudiante4') ||
        $request->filled('cedula4') || $request->filled('carrera4')) {
        $validationRules['nombre_estudiante4'] = 'required|string|max:255';
        $validationRules['apellido_estudiante4'] = 'required|string|max:255';
        $validationRules['cedula4'] = 'required|string|max:255';
        $validationRules['carrera4'] = 'required|string|max:255';
    }
    if ($request->filled('nombre_estudiante5') || $request->filled('apellido_estudiante5') ||
        $request->filled('cedula5') || $request->filled('carrera5')) {
        $validationRules['nombre_estudiante5'] = 'required|string|max:255';
        $validationRules['apellido_estudiante5'] = 'required|string|max:255';
        $validationRules['cedula5'] = 'required|string|max:255';
        $validationRules['carrera5'] = 'required|string|max:255';
    }

    $request->validate($validationRules);
    $servicio = ServicioComunitario::findOrFail($servicio->id);

    if ($request->hasFile('trabajo_servicio')) {
        if ($servicio->trabajo_servicio && Storage::disk('public')->exists($servicio->trabajo_servicio)) {
            Storage::disk('public')->delete($servicio->trabajo_servicio);
        }
        $data['trabajo_servicio'] = $request->file('trabajo_servicio')->store('servicios', 'public');
    }

    $servicio->nombre_estudiante = $request->nombre_estudiante;
    $servicio->apellido_estudiante = $request->apellido_estudiante;
    $servicio->cedula = $request->cedula;
    $servicio->carrera = $request->carrera;

    // Actualizar datos del estudiante 2
        $servicio->nombre_estudiante2 = $request->nombre_estudiante2;
        $servicio->apellido_estudiante2 = $request->apellido_estudiante2;
        $servicio->cedula2 = $request->cedula2;
        $servicio->carrera2 = $request->carrera2;
    
    // Actualizar datos del estudiante 3
        $servicio->nombre_estudiante3 = $request->nombre_estudiante3;
        $servicio->apellido_estudiante3 = $request->apellido_estudiante3;
        $servicio->cedula3 = $request->cedula3;
        $servicio->carrera3 = $request->carrera3;
    // Actualizar datos del estudiante 4   
        $servicio->nombre_estudiante4 = $request->nombre_estudiante4;
        $servicio->apellido_estudiante4 = $request->apellido_estudiante4;
        $servicio->cedula4 = $request->cedula4;
        $servicio->carrera4 = $request->carrera4;
    // Actualizar datos del estudiante 5
        $servicio->nombre_estudiante5 = $request->nombre_estudiante5;
        $servicio->apellido_estudiante5 = $request->apellido_estudiante5;
        $servicio->cedula5 = $request->cedula5;
        $servicio->carrera5 = $request->carrera5;  

    $servicio->save();

    return redirect()->route('admin.servicio_comunitario.index')->with('success', 'Servicio comunitario actualizado con éxito.');
}

    public function destroy(ServicioComunitario $servicio)
    {

        
        try {
            if ($servicio->trabajo_servicio && Storage::disk('public')->exists($servicio->trabajo_servicio)) {
                Storage::disk('public')->delete($servicio->trabajo_servicio);
            }
            $servicio->delete();
            return redirect()->route('admin.servicio_comunitario.index')->with('success', 'Servicio comunitario eliminado.');
        } catch (\Exception $e) {
            return redirect()->route('admin.servicio_comunitario.index')->with('error', 'Error al eliminar el servicio comunitario.');
        }
    }
}