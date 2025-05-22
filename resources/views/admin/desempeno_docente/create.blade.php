<x-admin>
    @section('title', 'Evaluar Docente')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.desempeno-docente.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="docente_id" class="form-label">Docente</label>
                    <select name="docente_id" id="docente_id" class="form-control">
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}" {{ (old('docente_id', $evaluacion->docente_id ?? '') == $docente->id) ? 'selected' : '' }}>
                                {{ $docente->nombre }} {{ $docente->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="unidad_curricular_periodo_academico_id" class="form-label">Unidad Curricular - Periodo</label>
                    <select name="unidad_curricular_periodo_academico_id" id="unidad_curricular_periodo_academico_id" class="form-control">
                        @foreach($unidadCurricularPeriodo as $item)
                            <option value="{{ $item->id }}" {{ (old('unidad_curricular_periodo_academico_id', $evaluacion->unidad_curricular_periodo_academico_id ?? '') == $item->id) ? 'selected' : '' }}>
                                {{ $item->unidadCurricular->nombre }} - {{ $item->periodoAcademico->periodo }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="puntualidad" class="form-label">Puntualidad (100%)</label>
                    <input type="number" class="form-control" name="puntualidad" value="{{ old('puntualidad', $evaluacion->puntualidad ?? '') }}">
                </div>
                
                <div class="mb-3">
                    <label for="calidad_ensenanza" class="form-label">Calidad de Enseñanza</label>
                    <input type="text" class="form-control" name="calidad_ensenanza" value="{{ old('calidad_ensenanza', $evaluacion->calidad_ensenanza ?? '') }}">
                </div>
                
                <div class="mb-3">
                    <label for="participacion_proyectos" class="form-label">Participación en Proyectos</label>
                    <input type="text" class="form-control" name="participacion_proyectos" value="{{ old('participacion_proyectos', $evaluacion->participacion_proyectos ?? '') }}">
                </div>
                
                <div class="mb-3">
                    <label for="cumplimiento_administrativo" class="form-label">Cumplimiento Administrativo</label>
                    <input type="text" class="form-control" name="cumplimiento_administrativo" value="{{ old('cumplimiento_administrativo', $evaluacion->cumplimiento_administrativo ?? '') }}">
                </div>
                
                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea class="form-control" name="observaciones">{{ old('observaciones', $evaluacion->observaciones ?? '') }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="evaluado_por" class="form-label">Evaluado por</label>
                    <select name="evaluado_por" id="evaluado_por"
                            class="form-control @error('evaluado_por') is-invalid @enderror">
                        <option value="" disabled selected>— Seleccione —</option>
                        @foreach($docentes as $doc)
                            <option value="{{ $doc->id }}"
                                {{ old('evaluado_por') == $doc->id ? 'selected' : '' }}>
                                {{ $doc->apellido }}, {{ $doc->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('evaluado_por') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                <div class="mb-3">
                    <label for="fecha_evaluacion" class="form-label">Fecha Evaluación</label>
                    <input type="date" class="form-control" name="fecha_evaluacion" value="{{ old('fecha_evaluacion', isset($evaluacion->fecha_evaluacion) ? $evaluacion->fecha_evaluacion->format('Y-m-d') : '') }}">
                </div>

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</x-admin>