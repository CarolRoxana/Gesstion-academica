<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Horario;
use Carbon\Carbon;

class HorarioPDFController extends Controller
{
    public function exportHorarioPDF()
    {
        // Establecer el locale en español
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'es_ES.utf8');
        
        $horarios = Horario::with(['docente', 'unidadCurricular'])
            ->orderBy('docente_id')
            ->orderBy('dia')
            ->orderBy('hora_inicio')
            ->get();

        $data = [
            'horarios' => $horarios,
            'fecha' => Carbon::now()->isoFormat('D [de] MMMM [de] YYYY, h:mm a'),
            'titulo' => 'Reporte de Horarios Docentes'
        ];

        $pdf = Pdf::loadView('admin.horario.pdf', $data)
            ->setPaper('A4', 'landscape');

        return $pdf->download('horarios_'.now()->format('Ymd_His').'.pdf');
    
    }
}