<?php
namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Events\AfterSheet;

class ProfesoresExport implements FromCollection, WithHeadings, WithStyles, WithEvents
{
    public function collection()
    {
        return DB::table('horarios')
            ->join('docentes', 'horarios.docente_id', '=', 'docentes.id')
            ->join('unidad_curricular', 'horarios.unidad_curricular_id', '=', 'unidad_curricular.id')
            ->join('seccions', 'horarios.seccion_id', '=', 'seccions.id')
            ->join('unidad_curricular_periodo_academico', function ($join) {
                $join->on('unidad_curricular_periodo_academico.unidad_curricular_id', '=', 'horarios.unidad_curricular_id')
                    ->on('unidad_curricular_periodo_academico.periodo_academico_id', '=', 'horarios.periodo_academico_id');
            })
            ->select(
                'horarios.sede as SEDE',
                DB::raw("CONCAT(docentes.nombre, ' ', docentes.apellido) as DOCENTE"),
                'docentes.cedula as CÉDULA',
                'docentes.correo as CORREO',
                'unidad_curricular.carrera as CARRERA',
                'unidad_curricular.nombre as UNIDAD_CURRICULAR',
                DB::raw('COUNT(DISTINCT horarios.seccion_id) as N_DE_SECCIONES'),
                'unidad_curricular_periodo_academico.modalidad as MODALIDAD'
            )
            ->groupBy(
                'horarios.sede',
                'docentes.nombre',
                'docentes.apellido',
                'docentes.cedula',
                'docentes.correo',
                'unidad_curricular.carrera',
                'unidad_curricular.nombre',
                'unidad_curricular_periodo_academico.modalidad'
            )
            ->get();
    }

    public function headings(): array
    {
        // Fila 1: Título, Fila 2: Encabezados de columnas
        return [
            ['LISTA DE PROFESORES'],
            [
                'SEDE',
                'DOCENTE',
                'CÉDULA',
                'CORREO',
                'CARRERA',
                'UNIDAD CURRICULAR',
                'N° DE SECCIONES',
                'MODALIDAD',
            ]
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Encabezado grande y centrado, encabezados de columnas en negrita y fondo gris
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 16],
                'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            ],
            2 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'D9D9D9']
                ],
            ],
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Fusionar celdas del título
                $event->sheet->mergeCells('A1:H1');
                // Ajustar ancho de columnas automáticamente
                foreach (range('A', 'H') as $col) {
                    $event->sheet->getDelegate()->getColumnDimension($col)->setAutoSize(true);
                }
                // Bordes para toda la tabla (desde fila 2 por los headings)
                $event->sheet->getStyle('A2:H' . $event->sheet->getHighestRow())
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                'color' => ['argb' => 'FF000000'],
                            ],
                        ],
                    ]);
            },
        ];
    }
}