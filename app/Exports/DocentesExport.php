<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithCustomStartCell; // Para empezar en una celda específica
use Maatwebsite\Excel\Concerns\WithStyles; // Para estilos
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet; // Para manipular la hoja de Excel
use Carbon\Carbon; // Para manejar la fecha

class DocentesExport implements FromCollection, WithHeadings, WithCustomStartCell, WithStyles
{
    public function collection()
    {
        return DB::table('unidad_curricular_periodo_academico as ucpa')
            ->join('docentes', 'ucpa.docente_id', '=', 'docentes.id')
            ->join('unidad_curricular as uc', 'uc.id', '=', 'ucpa.unidad_curricular_id')
            ->leftJoin('horarios as h', function($join) {
                $join->on('h.docente_id', '=', 'docentes.id')
                    ->on('h.unidad_curricular_id', '=', 'uc.id')
                    ->on('h.periodo_academico_id', '=', 'ucpa.periodo_academico_id');
            })
            ->select(
                'ucpa.sede',
                DB::raw("CONCAT(docentes.nombre, ' ', docentes.apellido) as docente"),
                'docentes.cedula',
                'docentes.correo',
                'uc.carrera',
                'uc.nombre as unidad_curricular',
                'h.seccion',
                'ucpa.modalidad'
            )
            ->get();
    }

    public function headings(): array
    {
        return [
            'SEDE',
            'DOCENTE',
            'CÉDULA',
            'CORREO',
            'CARRERA',
            'UNIDAD CURRICULAR',
            'SECCIÓN',
            'MODALIDAD',
        ];
    }

    public function startCell(): string
    {
        return 'A3'; // Los datos empezarán en A3 (dejamos A1 y A2 libres para el título)
    }

    public function styles(Worksheet $sheet)
    {
        // Agregar título y fecha en A1 y B1
        $sheet->mergeCells('A1:H1'); // Unir celdas para el título
        $sheet->setCellValue('A1', 'LISTADO DE DOCENTES');
        $sheet->setCellValue('I1', 'Fecha: ' . Carbon::now()->format('d/m/Y')); // Fecha actual

        // Estilo para el título (negrita, tamaño 14, centrado)
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Estilo para la fecha (negrita)
        $sheet->getStyle('I1')->getFont()->setBold(true);

        // Estilo para los encabezados (negrita, fondo gris)
        $sheet->getStyle('A3:H3')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => 'DDDDDD'],
            ],
        ]);
    }

}