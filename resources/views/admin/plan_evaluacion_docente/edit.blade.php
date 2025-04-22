<x-admin>
    @section('title', 'Editar Plan de Evaluación Docente')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.plan_evaluacion_docente.update', $planEvaluacion->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Unidad Curricular y Período Académico</label>
                    <select name="unidad_curricular_periodo_academico_id" class="form-control" required>
                        @foreach($unidadCurricularPeriodoAcademico as $uc)
                            <option value="{{ $uc->id }}" {{ $uc->id == $planEvaluacion->unidad_curricular_periodo_academico_id ? 'selected' : '' }}>
                                {{ $uc->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Porcentaje de Evaluación</label>
                    <input type="number" name="porcentaje_evaluacion" class="form-control" min="0" max="100" value="{{ $planEvaluacion->porcentaje_evaluacion }}" required>
                </div>
                <div class="form-group">
                    <label>Fecha de Evaluación</label>
                    <input type="datetime-local" name="fecha_evaluacion" class="form-control" value="{{ $planEvaluacion->fecha_evaluacion->format('Y-m-d\TH:i') }}" required>
                </div>
                <div class="form-group">
                    <label>Tipo de Evaluación</label>
                    <input type="text" name="tipo_evaluacion" class="form-control" value="{{ $planEvaluacion->tipo_evaluacion }}" required>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
</x-admin>
