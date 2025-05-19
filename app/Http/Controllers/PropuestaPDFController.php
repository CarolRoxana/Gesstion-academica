<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PropuestaTG; 
use App\Models\PropuestaTP; 
use Carbon\Carbon;

class PropuestaPDFController extends Controller
{
    public function exportGradoPDF()
    {
        return $this->exportPropuestas('grado');
    }

    public function exportPasantiaPDF()
    {
        return $this->exportPropuestas('pasantia');
    }

    private function exportPropuestas($tipo)
    {

        //SEDE
        //SEMESTRE
        //SECCION
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'es_ES.utf8');
        
        $modelo = ($tipo == 'grado') ? PropuestaTG::class : PropuestaTP::class;
        
        $propuestas = $modelo::with(['docente'])
            ->orderBy('fecha_ingreso', 'desc')
            ->get()
            ->map(function ($propuesta) use ($tipo) {
                // Agregamos campos formateados según el tipo
                $propuesta->nombre_completo = ($tipo == 'grado')
                    ? ($propuesta->nombre_tesista ?? '') . ' ' . ($propuesta->apellido_tesista ?? '')
                    : ($propuesta->nombre_pasante ?? '') . ' ' . ($propuesta->apellido_pasante ?? '');
                
                $propuesta->tipo_persona = ($tipo == 'grado') ? 'Tesista' : 'Pasante';
                
                return $propuesta;
            });

        $data = [
            'propuestas' => $propuestas,
            'fecha' => Carbon::now()->isoFormat('D [de] MMMM [de] YYYY'),
            'titulo' => ($tipo == 'grado') 
                ? 'Reporte de Propuestas de Trabajo de Grado' 
                : 'Reporte de Propuestas de Pasantías',
            'tipo' => $tipo
        ];

        return Pdf::loadView('admin.propuestas.pdf', $data)
            ->setPaper('A4', 'landscape')
            ->download('propuestas_'.$tipo.'_'.now()->format('Ymd_His').'.pdf');
    }
}