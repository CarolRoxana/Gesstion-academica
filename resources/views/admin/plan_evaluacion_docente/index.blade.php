{{-- filepath: resources/views/admin/plan_evaluacion_docente/index.blade.php --}}
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
                @forelse($planEvaluaciones as $plan)
                    @php
                        $ucpa = $plan->unidadCurricularPeriodoAcademico;
                        $docente = $ucpa?->docente;
                        $unidadCurricular = $ucpa?->unidadCurricular;
                    @endphp
                    <tr>
                        <td>
                            {{ $docente ? $docente->nombre . ' ' . $docente->apellido : 'Sin docente' }}
                        </td>
                        <td>
                            {{ $unidadCurricular ? $unidadCurricular->nombre : 'Sin unidad curricular' }}
                        </td>
                        <td>
                            <a href="{{ route('admin.plan_evaluacion_docente.show', $plan->id) }}" class="btn btn-info btn-sm">Ver</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No hay planes de evaluación registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin>