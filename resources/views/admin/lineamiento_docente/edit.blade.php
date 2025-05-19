<x-admin>
    @section('title', 'Editar Lineamiento Docente')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.lineamiento-docente.update', $lineamientoDocente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Docente</label>
                    <select name="docente_id" class="form-control" required>
                        @foreach ($docentes as $docente)
                            <option
                                value="{{ $docente->id }}"
                                {{ old('docente_id', $lineamientoDocente->docente_id) == $docente->id ? 'selected' : '' }}
                            >
                                {{ $docente->apellido }}, {{ $docente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                                <div class="mb-3">
                    <label for="fecha_supervision" class="form-label">Fecha Evaluación</label>
                    <input type="date" name="fecha_supervision"
                           class="form-control @error('fecha_supervision') is-invalid @enderror"
                           value="{{ old('fecha_supervision',
                                          optional($lineamientoDocente->fecha_supervision)->format('Y-m-d')) }}">
                    @error('fecha_supervision') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>Resumen</label>
                    <input
                        type="text"
                        name="resumen"
                        class="form-control"
                        value="{{ old('resumen', $lineamientoDocente->resumen) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Cumple Lineamientos</label>
                    <input
                        type="text"
                        name="cumple_lineamientos"
                        class="form-control"
                        value="{{ old('cumple_lineamientos', $lineamientoDocente->cumple_lineamientos) }}"
                        required
                    >
                </div>

                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea
                        name="observaciones"
                        class="form-control"
                    >{{ old('observaciones', $lineamientoDocente->observaciones) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Periodo Académico</label>
                    <select name="periodo_academico_id" class="form-control" required>
                        @foreach ($periodos as $periodo)
                            <option
                                value="{{ $periodo->id }}"
                                {{ old('periodo_academico_id', $lineamientoDocente->periodo_academico_id) == $periodo->id ? 'selected' : '' }}
                            >
                                {{ $periodo->periodo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar Lineamiento</button>
            </form>
        </div>
    </div>
</x-admin>
