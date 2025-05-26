<!-- filepath: resources/views/admin/servicio_comunitario/edit.blade.php -->
<x-admin>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Editar Servicio Comunitario</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.servicio_comunitario.update', $servicio->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="titulo_servicio" class="form-label">Título del Servicio</label>
                        <input type="text" name="titulo_servicio" id="titulo_servicio" class="form-control" required value="{{ old('titulo_servicio', $servicio->titulo_servicio) }}">
                    </div>

                    <div class="mb-3">
                        <label for="trabajo_servicio" class="form-label">Archivo PDF</label>
                        <input type="file" name="trabajo_servicio" id="trabajo_servicio" class="form-control" accept="application/pdf">
                        @if($servicio->trabajo_servicio)
                            <small class="text-muted">Archivo actual: <a href="{{ asset('storage/'.$servicio->trabajo_servicio) }}" target="_blank">Ver PDF</a></small>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="docente_id" class="form-label">Docente Tutor</label>
                        <select name="docente_id" id="docente_id" class="form-control" required>
                            <option value="">Seleccione un docente</option>
                            @foreach($docentes as $docente)
                                <option value="{{ $docente->id }}" {{ old('docente_id', $servicio->docente_id) == $docente->id ? 'selected' : '' }}>
                                    {{ $docente->nombre }} {{ $docente->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="estatus" class="form-label">Estatus</label>
                        <select name="estatus" id="estatus" class="form-control" required>
                            <option value="proceso" {{ old('estatus', $servicio->estatus) == 'proceso' ? 'selected' : '' }}>En Proceso</option>
                            <option value="pendiente" {{ old('estatus', $servicio->estatus) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            <option value="aprobada" {{ old('estatus', $servicio->estatus) == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                            <option value="rechazada" {{ old('estatus', $servicio->estatus) == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_ingreso" class="form-label">Fecha de Ingreso</label>
                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" class="form-control" required value="{{ old('fecha_ingreso', $servicio->fecha_ingreso) }}">
                    </div>

                    <hr>
                    <h5 class="mb-3">Datos de los Estudiantes</h5>
                    {{-- Primer estudiante (requerido) --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text" name="nombre_estudiante" class="form-control" placeholder="Nombre estudiante 1" value="{{ old('nombre_estudiante', $servicio->nombre_estudiante) }}" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="apellido_estudiante" class="form-control" placeholder="Apellido estudiante 1" value="{{ old('apellido_estudiante', $servicio->apellido_estudiante) }}" required>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="cedula" class="form-control" placeholder="Cédula estudiante 1" value="{{ old('cedula', $servicio->cedula) }}" required>
                        </div>
                        <div class="col-md-3">
                            <select name="carrera" class="form-control" required>
                                <option value="">Seleccione carrera</option>
                                @foreach($carreras as $carrera)
                                    <option value="{{ $carrera->id }}" {{ old('carrera', $servicio->carrera) == $carrera->id ? 'selected' : '' }}>
                                        {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    {{-- Estudiantes 2 a 6 (opcionales) --}}
                    @for ($i = 2; $i <= 6; $i++)
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <input type="text" name="nombre_estudiante{{ $i }}" class="form-control" placeholder="Nombre estudiante {{ $i }}" value="{{ old('nombre_estudiante'.$i, $servicio->{'nombre_estudiante'.$i}) }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="apellido_estudiante{{ $i }}" class="form-control" placeholder="Apellido estudiante {{ $i }}" value="{{ old('apellido_estudiante'.$i, $servicio->{'apellido_estudiante'.$i}) }}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="cedula{{ $i }}" class="form-control" placeholder="Cédula estudiante {{ $i }}" value="{{ old('cedula'.$i, $servicio->{'cedula'.$i}) }}">
                            </div>
                            <div class="col-md-3">
                                <select name="carrera{{ $i }}" class="form-control">
                                    <option value="">Seleccione carrera</option>
                                    @foreach($carreras as $carrera)
                                        <option value="{{ $carrera->id }}" {{ old('carrera'.$i, $servicio->{'carrera'.$i}) == $carrera->id ? 'selected' : '' }}>
                                            {{ $carrera->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-outline-danger btn-sm" onclick="limpiarEstudiante({{ $i }})" title="Eliminar estudiante">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endfor

                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-primary">Actualizar Servicio Comunitario</button>
                        <a href="{{ route('admin.servicio_comunitario.index') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
function limpiarEstudiante(i) {
    document.querySelector('[name="nombre_estudiante'+i+'"]').value = '';
    document.querySelector('[name="apellido_estudiante'+i+'"]').value = '';
    document.querySelector('[name="cedula'+i+'"]').value = '';
    document.querySelector('[name="carrera'+i+'"]').selectedIndex = 0;
}
</script>
</x-admin>