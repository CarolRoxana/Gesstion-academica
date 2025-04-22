<x-admin>
    @section('title', 'Detalle de Evaluación')

    <div class="card">
        <div class="card-body">
            <p><strong>Docente:</strong> {{ $evaluacion->docente->nombre }} {{ $evaluacion->docente->apellido }}</p>
            <p><strong>Unidad Curricular:</strong> {{ $evaluacion->unidadCurricularPeriodoAcademico->unidadCurricular->nombre }}</p>
            <p><strong>Periodo:</strong> {{ $evaluacion->unidadCurricularPeriodoAcademico->periodoAcademico->periodo }}</p>
            <p><strong>Puntualidad:</strong> {{ $evaluacion->puntualidad }}</p>
            <p><strong>Calidad de Enseñanza:</strong> {{ $evaluacion->calidad_ensenanza }}</p>
            <p><strong>Participación en Proyectos:</strong> {{ $evaluacion->participacion_proyectos }}</p>
            <p><strong>Cumplimiento Administrativo:</strong> {{ $evaluacion->cumplimiento_administrativo }}</p>
            <p><strong>Observaciones:</strong> {{ $evaluacion->observaciones }}</p>
            <p><strong>Evaluado Por:</strong> {{ $evaluacion->evaluado_por }}</p>
            <p><strong>Fecha Evaluación:</strong> {{ $evaluacion->fecha_evaluacion->format('Y-m-d') }}</p>
        </div>
    </div>
</x-admin>
