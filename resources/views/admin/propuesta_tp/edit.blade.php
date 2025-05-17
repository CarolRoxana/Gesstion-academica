<x-admin>
    @section('title', 'Editar Propuesta TP')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.propuesta_tp.update', $propuesta->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nombre del Pasante</label>
                    <input type="text" name="nombre_pasante" class="form-control" value="{{ old('nombre_pasante', $propuesta->nombre_pasante) }}" required>
                </div>

                <div class="form-group">
                    <label>Apellido del Pasante</label>
                    <input type="text" name="apellido_pasante" class="form-control" value="{{ old('apellido_pasante', $propuesta->apellido_pasante) }}" required>
                </div>

                <div class="form-group">
                    <label>Cédula</label>
                    <input type="text" name="cedula" class="form-control" value="{{ old('cedula', $propuesta->cedula) }}" required>
                </div>

                <div class="form-group">
                    <label>Carrera</label>
                    <select name="carrera" class="form-control" required>
                        <option value="">Seleccione una carrera</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera }}" {{ old('carrera', $propuesta->carrera) === $carrera ? 'selected' : '' }}>
                                {{ $carrera }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Título de la Propuesta</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $propuesta->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label>Docente Asignado</label>
                    <select name="docente_id" class="form-control" required>
                        <option value="">Seleccione un docente</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}" {{ old('docente_id', $propuesta->docente_id) == $docente->id ? 'selected' : '' }}>
                                {{ $docente->nombre }} {{ $docente->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Estatus</label>
                    <select name="estatus" class="form-control" required>
                        <option value="pendiente" {{ old('estatus', $propuesta->estatus) === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en_proceso" {{ old('estatus', $propuesta->estatus) === 'en_proceso' ? 'selected' : '' }}>En proceso</option>
                        <option value="aprobada" {{ old('estatus', $propuesta->estatus) === 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                        <option value="rechazada" {{ old('estatus', $propuesta->estatus) === 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', $propuesta->fecha_ingreso ? \Carbon\Carbon::parse($propuesta->fecha_ingreso)->toDateString() : '') }}" required>
                </div>

                <div class="form-group">
                    <label>Fecha de Entrega</label>
                    <input type="date" name="fecha_entrega" class="form-control" value="{{ old('fecha_entrega', $propuesta->fecha_entrega ? \Carbon\Carbon::parse($propuesta->fecha_entrega)->toDateString() : '') }}" required>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion', $propuesta->descripcion) }}</textarea>
                </div>

                <div class="form-group">
                    <label>Archivo del plan de trabajo de la propuesta (PDF)</label>
                    <input type="file" name="propuesta" class="form-control" accept="application/pdf">
                    @if($propuesta->propuesta)
                        <a href="{{ asset('storage/' . $propuesta->propuesta) }}" target="_blank" class="btn btn-info mt-2">Ver PDF Actual</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
</x-admin>
