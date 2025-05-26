{{-- filepath: resources/views/admin/plan_evaluacion_docente/edit.blade.php --}}
<x-admin>
    @section('title', 'Editar Plan de Evaluación Docente')
    <div class="card">
        <div class="card-header">
            Editar Plan de Evaluación Docente
            <a href="{{ route('admin.plan_evaluacion_docente.index') }}" class="btn btn-secondary btn-sm float-end">Atrás</a>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.plan_evaluacion_docente.update', $plan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="docente_id" class="form-label">Docente</label>
                    <select name="docente_id" id="docente_id" class="form-control" required>
                        <option value="">Seleccione un docente</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}" {{ old('docente_id', $plan->docente_id) == $docente->id ? 'selected' : '' }}>
                                {{ $docente->apellido }}, {{ $docente->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('docente_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="unidad_curricular_periodo_academico_id" class="form-label">Unidad Curricular</label>
                    <select name="unidad_curricular_periodo_academico_id" id="unidad_curricular_periodo_academico_id" class="form-control" required>
                        <option value="">Seleccione una unidad curricular</option>
                        @foreach($unidades as $unidad)
                            <option value="{{ $unidad->id }}" {{ old('unidad_curricular_periodo_academico_id', $plan->unidad_curricular_periodo_academico_id) == $unidad->id ? 'selected' : '' }}>
                                {{ $unidad->unidadCurricular->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('unidad_curricular_periodo_academico_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="tipo_evaluacion" class="form-label">Tipo de Evaluación</label>
                    <select name="tipo_evaluacion" class="form-control @error('tipo_evaluacion') is-invalid @enderror" required>
                        <option value="">Seleccione el tipo de evaluación</option>
                        <option value="Examen Parcial" {{ old('tipo_evaluacion') == 'Examen Parcial' ? 'selected' : '' }}>Examen Parcial</option>
                        <option value="Examen Final" {{ old('tipo_evaluacion') == 'Examen Final' ? 'selected' : '' }}>Examen Final</option>
                        <option value="Trabajo Práctico" {{ old('tipo_evaluacion') == 'Trabajo Práctico' ? 'selected' : '' }}>Trabajo Práctico</option>
                        <option value="Proyecto" {{ old('tipo_evaluacion') == 'Proyecto' ? 'selected' : '' }}>Proyecto</option>
                        <option value="Presentación" {{ old('tipo_evaluacion') == 'Presentación' ? 'selected' : '' }}>Presentación</option>
                        <option value="Tarea" {{ old('tipo_evaluacion') == 'Tarea' ? 'selected' : '' }}>Tarea</option>
                        <option value="Quiz" {{ old('tipo_evaluacion') == 'Quiz' ? 'selected' : '' }}>Quiz</option>
                        <option value="Participación" {{ old('tipo_evaluacion') == 'Participación' ? 'selected' : '' }}>Participación</option>
                        <option value="Otro" {{ old('tipo_evaluacion') == 'Otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('tipo_evaluacion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="porcentaje_evaluacion" class="form-label">Porcentaje</label>
                    <input type="number" name="porcentaje_evaluacion" id="porcentaje_evaluacion" class="form-control"
                        value="{{ old('porcentaje_evaluacion', $plan->porcentaje_evaluacion) }}" min="0" max="100" required>
                    @error('porcentaje_evaluacion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_evaluacion" class="form-label">Fecha de Evaluación</label>
                    <input type="date" name="fecha_evaluacion" id="fecha_evaluacion" class="form-control"
                        value="{{ old('fecha_evaluacion', $plan->fecha_evaluacion ? $plan->fecha_evaluacion->format('Y-m-d') : '') }}" required>
                    @error('fecha_evaluacion')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>
            </form>
        </div>
    </div>
</x-admin>