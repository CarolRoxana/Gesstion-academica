{{-- filepath: resources/views/admin/plan_evaluacion_docente/edit.blade.php --}}
<x-admin>
    @section('title', 'Editar Plan de Evaluación Docente')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span>Editar Plan de Evaluación Docente</span>
            <a href="{{ route('admin.plan_evaluacion_docente.index') }}" class="btn btn-secondary btn-sm">
                Atrás
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.plan_evaluacion_docente.update', $plan->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label>Unidad Curricular</label>
                    <input type="text" class="form-control" value="{{ optional($plan->unidadCurricularPeriodoAcademico?->unidadCurricular)->nombre }}" disabled>
                </div>
                <div class="mb-3">
                    <label>Tipo de Evaluación</label>
                    <input type="text" name="tipo_evaluacion" class="form-control" value="{{ $plan->tipo_evaluacion }}" required>
                </div>
                <div class="mb-3">
                    <label>Porcentaje</label>
                    <input type="number" name="porcentaje_evaluacion" class="form-control" value="{{ $plan->porcentaje_evaluacion }}" min="0" max="100" required>
                </div>
                <div class="mb-3">
                    <label>Fecha de Evaluación</label>
                    <input type="date" name="fecha_evaluacion" class="form-control" value="{{ $plan->fecha_evaluacion }}" required>
                </div>
                <button type="submit" class="btn btn-success">Guardar Cambios</button>
            </form>
        </div>
    </div>
</x-admin>