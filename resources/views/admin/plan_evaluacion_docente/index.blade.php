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
                        <th>Tipo de Evaluación</th>
                        <th>Porcentaje</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($planEvaluaciones as $plan)
                    <tr>
                        <td>
                            {{ $plan->docente
                                ? $plan->docente->apellido . ', ' . $plan->docente->nombre
                                : 'No asignado' }}
                        </td>
                        <td>
                            {{ $plan->unidadCurricularPeriodoAcademico && $plan->unidadCurricularPeriodoAcademico->unidadCurricular
                                ? $plan->unidadCurricularPeriodoAcademico->unidadCurricular->nombre
                                : 'No asignada' }}
                        </td>
                        <td>{{ $plan->tipo_evaluacion }}</td>
                        <td>{{ $plan->porcentaje_evaluacion }}%</td>
                        <td>{{ $plan->fecha_evaluacion ? \Carbon\Carbon::parse($plan->fecha_evaluacion)->format('d/m/Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.plan_evaluacion_docente.show', $plan->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('admin.plan_evaluacion_docente.edit', $plan->id) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('admin.plan_evaluacion_docente.destroy', $plan->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar este plan?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay planes de evaluación registrados.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin>