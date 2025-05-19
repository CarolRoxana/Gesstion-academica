<x-admin>
    @section('title', 'Editar Evaluación')

    <div class="card">
        <div class="card-body">

            <form action="{{ route('admin.desempeno-docente.update', $desempenoDocente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="docente_id" class="form-label">Docente</label>
                    <select name="docente_id" id="docente_id"
                            class="form-control @error('docente_id') is-invalid @enderror">
                        <option disabled>— Seleccione —</option>
                        @foreach($docentes as $doc)
                            <option value="{{ $doc->id }}"
                                {{ old('docente_id', $desempenoDocente->docente_id) == $doc->id ? 'selected' : '' }}>
                                {{ $doc->apellido }}, {{ $doc->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('docente_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="unidad_curricular_periodo_academico_id" class="form-label">
                        Unidad Curricular – Periodo
                    </label>
                    <select name="unidad_curricular_periodo_academico_id"
                            id="unidad_curricular_periodo_academico_id"
                            class="form-control @error('unidad_curricular_periodo_academico_id') is-invalid @enderror">
                        <option disabled>— Seleccione —</option>
                        @foreach($unidades as $item)
                            <option value="{{ $item->id }}"
                                {{ old('unidad_curricular_periodo_academico_id',
                                       $desempenoDocente->unidad_curricular_periodo_academico_id) == $item->id ? 'selected' : '' }}>
                                {{ $item->unidadCurricular->nombre }} – {{ $item->periodoAcademico->periodo }}
                            </option>
                        @endforeach
                    </select>
                    @error('unidad_curricular_periodo_academico_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                <label for="puntualidad" class="form-label">Puntualidad</label>

                <input  type="number"
                        name="puntualidad"
                        id="puntualidad"
                        min="1"
                        max="100"
                        step="1"
                        value="{{ old('puntualidad', $desempenoDocente->puntualidad) }}"
                        class="form-control @error('puntualidad') is-invalid @enderror"

                        onwheel="this.blur();"

                        onkeydown="return event.key !== 'ArrowUp' && event.key !== 'ArrowDown';"
                >

                @error('puntualidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

                <div class="mb-3">
                    <label for="calidad_ensenanza" class="form-label">Calidad de Enseñanza</label>
                    <input type="text" name="calidad_ensenanza"
                           class="form-control @error('calidad_ensenanza') is-invalid @enderror"
                           value="{{ old('calidad_ensenanza', $desempenoDocente->calidad_ensenanza) }}">
                    @error('calidad_ensenanza') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="participacion_proyectos" class="form-label">Participación en Proyectos</label>
                    <input type="text" name="participacion_proyectos"
                           class="form-control @error('participacion_proyectos') is-invalid @enderror"
                           value="{{ old('participacion_proyectos', $desempenoDocente->participacion_proyectos) }}">
                    @error('participacion_proyectos') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="cumplimiento_administrativo" class="form-label">Cumplimiento Administrativo</label>
                    <input type="text" name="cumplimiento_administrativo"
                           class="form-control @error('cumplimiento_administrativo') is-invalid @enderror"
                           value="{{ old('cumplimiento_administrativo', $desempenoDocente->cumplimiento_administrativo) }}">
                    @error('cumplimiento_administrativo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="observaciones" class="form-label">Observaciones</label>
                    <textarea name="observaciones"
                              class="form-control @error('observaciones') is-invalid @enderror"
                              rows="3">{{ old('observaciones', $desempenoDocente->observaciones) }}</textarea>
                    @error('observaciones') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="evaluado_por" class="form-label">Evaluado por</label>
                    <select name="evaluado_por" id="evaluado_por"
                            class="form-control @error('evaluado_por') is-invalid @enderror">
                        <option disabled>— Seleccione —</option>
                        @foreach($docentes as $doc)
                            <option value="{{ $doc->id }}"
                                {{ old('evaluado_por', $desempenoDocente->evaluado_por) == $doc->id ? 'selected' : '' }}>
                                {{ $doc->apellido }}, {{ $doc->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('evaluado_por') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="fecha_evaluacion" class="form-label">Fecha Evaluación</label>
                    <input type="date" name="fecha_evaluacion"
                           class="form-control @error('fecha_evaluacion') is-invalid @enderror"
                           value="{{ old('fecha_evaluacion',
                                          optional($desempenoDocente->fecha_evaluacion)->format('Y-m-d')) }}">
                    @error('fecha_evaluacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('admin.desempeno-docente.index') }}" class="btn btn-secondary ms-2">Volver</a>
            </form>
        </div>
    </div>
</x-admin>
