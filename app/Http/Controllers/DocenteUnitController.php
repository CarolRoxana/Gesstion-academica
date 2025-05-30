<?php

namespace App\Http\Controllers;

use App\Models\Docente;
use App\Models\User;
use Illuminate\Http\Request;

class DocenteUnitController extends Controller
{
    public function index()
    {
        //DAME LOS DATOS DEL USUARIO AUTENTICADO
        $user = auth()->user();

        //DAME EL DOCENTE QUE TIENE EL MISMO ID QUE EL DEL USUARIO AUTENTICADO
        $docentes = Docente::where('user_id', $user->id)->get();


        return view('admin.docente_unit.index', compact('docentes'));
    }

    public function create()
    {
        return view('admin.docente_unit.create');
    }

    public function store(Request $request)
    {
        abort(404);
    }

    public function show($docente_unit)
    {

        //DAME EL DOCENTE QUE TIENE EL ID DE PARAMETRO
        $docente = Docente::findOrFail($docente_unit);


        $asignaciones = $docente->unidadesAsignadas()->with(['unidadCurricular', 'periodoAcademico'])->get();
        $propuestasTG = $docente->propuestasTG;
        $propuestasTP = $docente->propuestasTP;
        $horarios = $docente->horarios()->with(['unidadCurricular', 'seccion', 'periodoAcademico'])->get();
        $desempenos = $docente->desempenos()->with(['unidadCurricularPeriodoAcademico.periodoAcademico', 'unidadCurricularPeriodoAcademico.unidadCurricular'])->get();
        $servicios = $docente->serviciosComunitarios()->latest('fecha_ingreso')->get();
        $lineamientos = $docente->lineamientos()->latest()->get();
        $temarios = $docente->temarios()->latest('fecha_agregado')->get();
        $evaluacionesDocente = $docente->evaluacionesDocente()->latest('fecha_evaluacion')->get();



        return view('admin.docente_unit.show', compact(
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

    public function edit($docente_unit)
    {
        //DAME EL DOCENTE QUE TIENE EL ID DE PARAMETRO
        $docente = Docente::findOrFail($docente_unit);

        return view('admin.docente_unit.edit', compact('docente'));
    }

    public function update(Request $request, $docente_unit)
    {


        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:docentes,cedula,' . $docente_unit,
            'titulo' => 'required|string|max:255',
            'correo' => 'required|email|unique:docentes,correo,' . $docente_unit,
            'telefono' => 'nullable|string|max:20',
            'maestria' => 'nullable|string|max:255',
            'doctorado' => 'nullable|string|max:255',
            'postgrado' => 'nullable|string|max:255',
            'otro' => 'nullable|string|max:255',
            'categoria' => 'nullable|in:Categoría 1,Categoría 2,Categoría 3','Categoría 4','Categoría 5',
            'tipo_contratacion' => 'nullable|in:Fijo,Honorario profesionales,Contratación especial',
        ]);

        $docente = Docente::findOrFail($docente_unit);
        $docente->fill($request->all());
        $docente->save();
        
     
        $user = User::findOrFail($docente->user_id);
           //actualizar el campo de password en la tabla de usuarios    
        $user->password = bcrypt($request->input('cedula'));
        $user->save();

        
        return redirect()->route('admin.docente_unit.index')->with('success', 'Docente actualizado correctamente.');
    }

    public function destroy(Docente $docente)
    {

        try {
            $docente->delete();
            return redirect()->route('admin.docente_unit.index')->with('success', 'Docente eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.docente_unit.index')->with('error', 'No se puede eliminar el docente porque tiene asignaciones.');
        }
   }
}
