<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\UnidadCurricular;
use App\Models\User;
use Illuminate\Http\Request;

class DocenteController extends Controller
{
    public function index()
    {
        $docentes = Docente::all();
        return view('admin.docente.index', compact('docentes'));
    }

    public function create()
    {
        return view('admin.docente.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:docentes',
            'titulo' => 'required|string|max:255',
            'correo' => 'required|email|unique:docentes',
            'telefono' => 'nullable|string|max:20',
            'maestria' => 'nullable|string|max:255',
            'doctorado' => 'nullable|string|max:255',
            'postgrado' => 'nullable|string|max:255',
            'otro' => 'nullable|string|max:255',
            'categoria' => 'nullable|in:Categoría 1,Categoría 2,Categoría 3',
            'tipo_contratacion' => 'nullable|in:Fijo,Honorario profesionales,Contratación especial',
        ]);

        //Verifica que existe el rol de tipo Docente
        $rolDocente = \Spatie\Permission\Models\Role::where('name', 'Docente')->first();
        if (!$rolDocente) {
            return redirect()->route('admin.docente.index')->with('error', 'El rol de Docente no existe.');
        }

        //crea un usuario 
        $user = new User();
        $user->name = $request->nombre . ' ' . $request->apellido;
        $user->email = $request->correo;
        $user->password = bcrypt($request->cedula); // Asigna la cédula como contraseña
        $user->save();
        // Asigna el rol de Docente al usuario
        $user->assignRole($rolDocente);
        // Asigna el ID del usuario al docente
        $docente = new Docente();
        $docente->nombre = $request->nombre;
        $docente->apellido = $request->apellido;
        $docente->cedula = $request->cedula;
        $docente->correo = $request->correo;
        $docente->telefono = $request->telefono;
        $docente->titulo = $request->titulo;
        $docente->maestria = $request->maestria;
        $docente->doctorado = $request->doctorado;
        $docente->postgrado = $request->postgrado;
        $docente->otro = $request->otro;
        $docente->categoria = $request->categoria;
        $docente->tipo_contratacion = $request->tipo_contratacion;
        $docente->user_id = $user->id; // Asigna el ID del usuario al docente
        $docente->save();

        return redirect()->route('admin.docente.index')->with('success', 'Docente creado correctamente.');
    }

    public function show(Docente $docente)
    {
        $asignaciones = $docente->unidadesAsignadas()->with(['unidadCurricular', 'periodoAcademico'])->get();
        $propuestasTG = $docente->propuestasTG;
        $propuestasTP = $docente->propuestasTP;
        $horarios = $docente->horarios()->with(['unidadCurricular', 'seccion', 'periodoAcademico'])->get();
        $desempenos = $docente->desempenos()->with(['unidadCurricularPeriodoAcademico.periodoAcademico', 'unidadCurricularPeriodoAcademico.unidadCurricular'])->get();
        $servicios = $docente->serviciosComunitarios()->latest('fecha_ingreso')->get();
        $lineamientos = $docente->lineamientos()->latest()->get();
      $temarios = $docente->temarios()->with('unidadCurricularPeriodoAcademico.unidadCurricular', 'unidadCurricularPeriodoAcademico.periodoAcademico')->get();
        $evaluacionesDocente = $docente->evaluacionesDocente()->latest('fecha_evaluacion')->get();


        return view('admin.docente.show', compact(
            'docente',
            'temarios',
            'evaluacionesDocente',
            'asignaciones',
            'propuestasTG',
            'propuestasTP',
            'horarios',
            'desempenos',
            'servicios',
            'lineamientos'
        ));
    }

    public function edit(Docente $docente)
    {
        return view('admin.docente.editt', compact('docente'));
    }

    public function update(Request $request, Docente $docente)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:docentes,cedula,' . $docente->id,
            'titulo' => 'required|string|max:255',
            'correo' => 'required|email|unique:docentes,correo,' . $docente->id,
            'telefono' => 'nullable|string|max:20',
            'maestria' => 'nullable|string|max:255',
            'doctorado' => 'nullable|string|max:255',
            'postgrado' => 'nullable|string|max:255',
            'otro' => 'nullable|string|max:255',
            'categoria' => 'nullable|in:Categoría 1,Categoría 2,Categoría 3',
            'tipo_contratacion' => 'nullable|in:Fijo,Honorario profesionales,Contratación especial',
        ]);

        $docente->fill($request->all());
        //$docente->rol_id = 3;
        $docente->save();

        return redirect()->route('admin.docente.index')->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy(Docente $docente)
    {
        try {
            $docente->delete();
            return redirect()->route('admin.docente.index')->with('success', 'Docente eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.docente.index')->with('error', 'No se puede eliminar el docente porque tiene registros asociados.');
        }
    }
}
