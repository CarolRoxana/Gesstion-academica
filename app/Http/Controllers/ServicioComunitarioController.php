<?php

namespace App\Http\Controllers;

use App\Models\ServicioComunitario;
use App\Models\Docente;
use App\Models\UnidadCurricular;
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
        $carreras = UnidadCurricular::select('carrera')->distinct()->pluck('carrera');
        return view('admin.servicio_comunitario.create', compact('docentes', 'carreras'));
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre_estudiante'   => 'required|string|max:255',
            'apellido_estudiante' => 'required|string|max:255',
            'cedula'              => 'required|string|max:20',
            'carrera'             => 'required|string|max:100',
            'titulo_servicio'     => 'required|string|max:255',
            'trabajo_servicio'    => 'required|file|mimes:pdf|max:10240',
            'docente_id'          => 'required|exists:docentes,id',
            'estatus'             => 'required|in:proceso,pendiente,aprobado,rechazado',
            'fecha_ingreso'       => 'required|date',
        ];
        $data = $request->validate($rules);

        $data['trabajo_servicio'] = $request->file('trabajo_servicio')->store('servicios', 'public');

        ServicioComunitario::create($data);

        return redirect()->route('admin.servicio_comunitario.index')->with('success', 'Servicio comunitario registrado.');
    }

    public function edit(ServicioComunitario $servicio)
    {
        $docentes = Docente::all();
        $carreras = UnidadCurricular::select('carrera')->distinct()->pluck('carrera');
        return view('admin.servicio_comunitario.edit', compact('servicio', 'docentes', 'carreras'));
    }

    public function update(Request $request, ServicioComunitario $servicio)
    {
        $rules = [
            'nombre_estudiante'   => 'required|string|max:255',
            'apellido_estudiante' => 'required|string|max:255',
            'cedula'              => 'required|string|max:20',
            'carrera'             => 'required|string|max:100',
            'titulo_servicio'     => 'required|string|max:255',
            'trabajo_servicio'    => 'nullable|file|mimes:pdf|max:10240',
            'docente_id'          => 'required|exists:docentes,id',
            'estatus'             => 'required|in:proceso,pendiente,aprobado,rechazado',
            'fecha_ingreso'       => 'required|date',
        ];
        $data = $request->validate($rules);

        if ($request->hasFile('trabajo_servicio')) {
            if ($servicio->trabajo_servicio && Storage::disk('public')->exists($servicio->trabajo_servicio)) {
                Storage::disk('public')->delete($servicio->trabajo_servicio);
            }
            $data['trabajo_servicio'] = $request->file('trabajo_servicio')->store('servicios', 'public');
        }

        $servicio->update($data);

        return redirect()->route('admin.servicio_comunitario.index')->with('success', 'Servicio comunitario actualizado.');
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
