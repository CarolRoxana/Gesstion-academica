<x-admin>
    @section('title', 'Planes de Evaluación Docente')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.plan_evaluacion_docente.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Nuevo Plan de Evaluación
            </a>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Docente</th>
                        <th>Unidad Curricular</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($planEvaluaciones->groupBy(fn($plan) => $plan->unidadCurricularPeriodoAcademico->docente->id) as $docenteId => $evaluaciones)
                        @php
                            $docente = $evaluaciones->first()->unidadCurricularPeriodoAcademico->docente;
                        @endphp
                        <tr>
                            <th>{{ $docente->unidadCurricularPeriodoAcademico->nombre }}</th>
                            <td>{{ $docente->nombre }} {{ $docente->apellido }}</td>
                            <td>
                                <a href="{{ route('admin.plan_evaluacion_docente.show', $docente->id) }}" class="btn btn-info">Ver Evaluaciones</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>
