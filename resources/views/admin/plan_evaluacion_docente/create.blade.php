<x-admin>
    @section('title', 'Crear Plan de Evaluación Docente')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.plan_evaluacion_docente.store') }}" method="POST">
                @csrf
                
                 <div class="mb-3">
                    <label for="unidad_curricular_periodo_academico_id" class="form-label">Unidad Curricular</label>
                    <select name="unidad_curricular_periodo_academico_id" id="unidad_curricular_periodo_academico_id" class="form-control" required>
                        <option value="">Seleccione una unidad curricular</option>
                        @foreach($unidades as $unidad)
                            <option value="{{ $unidad->id }}" {{ old('unidad_curricular_periodo_academico_id') == $unidad->id ? 'selected' : '' }}>
                                {{ $unidad->unidadCurricular->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('unidad_curricular_periodo_academico_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="docente_id" class="form-label">Docente</label>
                    <select name="docente_id" id="docente_id" class="form-control" required>
                        <option value="">Seleccione un docente</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}" {{ old('docente_id') == $docente->id ? 'selected' : '' }}>
                                {{ $docente->apellido }}, {{ $docente->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('docente_id')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Porcentaje de Evaluación</label>
                    <input type="number" 
                           name="porcentaje_evaluacion" 
                           class="form-control @error('porcentaje_evaluacion') is-invalid @enderror" 
                           min="1" 
                           max="100" 
                           value="{{ old('porcentaje_evaluacion') }}"
                           required>
                    @error('porcentaje_evaluacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Ingrese un valor entre 1 y 100</small>
                </div>

                <div class="form-group">
                    <label>Fecha de Evaluación</label>
                    <input type="date" 
                           name="fecha_evaluacion" 
                           class="form-control @error('fecha_evaluacion') is-invalid @enderror" 
                           value="{{ old('fecha_evaluacion', \Carbon\Carbon::now()->format('Y-m-d')) }}" 
                           required>
                    @error('fecha_evaluacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Tipo de Evaluación</label>
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
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-success">
                        Crear Plan de Evaluación
                    </button>
                    <a href="{{ route('admin.plan_evaluacion_docente.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-admin>