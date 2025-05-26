<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\TemarioDocente;
use App\Models\UnidadCurricularPeriodoAcademico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemarioDocenteController extends Controller
{
    public function index()
    {
        $temarios = TemarioDocente::with([
        'docente',
        'unidadCurricularPeriodoAcademico.unidadCurricular'
        ])->get();

        return view('admin.temario_docente.index', compact('temarios'));
    }

    public function create()
    {
        $unidadCurricularPeriodoAcademico = UnidadCurricularPeriodoAcademico::with('unidadCurricular', 'periodoAcademico')->get();
        $docentes = Docente::orderBy('apellido')->get();

        return view('admin.temario_docente.create', compact('unidadCurricularPeriodoAcademico', 'docentes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unidad_curricular_periodo_academico_id' => 'required|exists:unidad_curricular_periodo_academico,id',
            'contenido' => 'required|file|mimes:pdf|max:10240',
            'fecha_agregado' => 'required|date',
            'docente_id' => 'required|exists:docentes,id',
        ]);

        // Procesar el archivo
        $validated['contenido'] = $request->file('contenido')->store('temarios', 'public');

        // Crear el temario con todos los datos validados (incluyendo docente_id)
        TemarioDocente::create($validated);

        return redirect()->route('admin.temario_docente.index')->with('success', 'Temario agregado con éxito.');
    }

    public function edit($id)
    {
        $temario = TemarioDocente::findOrFail($id);
        $unidadCurricularPeriodoAcademico = UnidadCurricularPeriodoAcademico::with('unidadCurricular', 'periodoAcademico')->get();
        $docentes = Docente::orderBy('apellido')->get();

        return view('admin.temario_docente.edit', compact('temario', 'unidadCurricularPeriodoAcademico', 'docentes'));
    }

    public function update(Request $request, $id)

    {
        $temario = TemarioDocente::findOrFail($id);
      
        
        $validated = $request->validate([
            'unidad_curricular_periodo_academico_id' => 'required|exists:unidad_curricular_periodo_academico,id',
            'contenido' => 'nullable|file|mimes:pdf|max:10240',
            'fecha_agregado' => 'required|date',
            'docente_id' => 'required|exists:docentes,id',
        ]);
        
        if ($request->hasFile('contenido')) {
            if ($temario->contenido && Storage::disk('public')->exists($temario->contenido)) {
                Storage::disk('public')->delete($temario->contenido);
            }
            $validated['contenido'] = $request->file('contenido')->store('temarios', 'public');
        }
        
      $validated['docente_id'] = $request->input('docente_id'); // Aseguramos que docente_id se actualice
      $temario->docente_id = $validated['docente_id'];
        $temario->save();
    
       
    


        return redirect()->route('admin.temario_docente.index')->with('success', 'Temario actualizado correctamente.');
    }

    public function destroy($id)
    {
        try {
            $temario = TemarioDocente::findOrFail($id);

            if ($temario->contenido && Storage::disk('public')->exists($temario->contenido)) {
                Storage::disk('public')->delete($temario->contenido);
            }

            $temario->delete();

            return redirect()->route('admin.temario_docente.index')->with('success', 'Temario eliminado con éxito.');
        } catch (\Exception $e) {
            return redirect()->route('admin.temario_docente.index')->with('error', 'Error al eliminar el temario.');
        }
    }
}
