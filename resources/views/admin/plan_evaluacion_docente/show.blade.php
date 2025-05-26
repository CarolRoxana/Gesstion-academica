{{-- filepath: resources/views/admin/plan_evaluacion_docente/show.blade.php --}}
<x-admin>
    @section('title', 'Detalle del Plan de Evaluación Docente')
    <div class="card">
        <div class="card-header">
            Detalle del Plan de Evaluación Docente
             <a href="{{ route('admin.plan_evaluacion_docente.create') }}" class="btn btn-sm btn-primary">
                <i class="fas fa-plus-circle me-1"></i> Agregar evaluación
            </a>
            <a href="{{ route('admin.plan_evaluacion_docente.edit', $plan->id) }}" class="btn btn-warning btn-sm float-end">
                Editar
            </a>
            <a href="{{ route('admin.plan_evaluacion_docente.index') }}" class="btn btn-secondary btn-sm">
                Atrás
            </a>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-4">Unidad Curricular</dt>
                <dd class="col-sm-8">
                    {{ optional($plan->unidadCurricularPeriodoAcademico?->unidadCurricular)->nombre ?? 'Sin unidad curricular' }}
                </dd>
                <dt class="col-sm-4">Docente</dt>
                <dd class="col-sm-8">
                    {{ optional($plan->docente)->nombre ?? 'Sin docente' }}
                    {{ optional($plan->docente)->apellido ?? '' }}
                </dd>
                <dt class="col-sm-4">Tipo de Evaluación</dt>
                <dd class="col-sm-8">{{ $plan->tipo_evaluacion }}</dd>
                <dt class="col-sm-4">Porcentaje</dt>
                <dd class="col-sm-8">{{ $plan->porcentaje_evaluacion }} %</dd>
                <dt class="col-sm-4">Fecha de Evaluación</dt>
                <dd class="col-sm-8">{{ \Carbon\Carbon::parse($plan->fecha_evaluacion)->format('d-m-Y') }}</dd>
            </dl>
        </div>
    </div>
</x-admin>