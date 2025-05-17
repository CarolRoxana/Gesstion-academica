<x-admin>
    @section('title', 'Editar Propuesta TG')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.propuesta_tg.update', $propuesta->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Nombre del Tesista</label>
                    <input type="text" name="nombre_tesista" class="form-control" value="{{ old('nombre_tesista', $propuesta->nombre_tesista) }}" required>
                </div>

                <div class="form-group">
                    <label>Apellido del Tesista</label>
                    <input type="text" name="apellido_tesista" class="form-control" value="{{ old('apellido_tesista', $propuesta->apellido_tesista) }}" required>
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
                            <option value="{{ $carrera }}" {{ old('carrera', $propuesta->carrera) == $carrera ? 'selected' : '' }}>
                                {{ $carrera }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Título de la Propuesta</label>
                    <input type="text" name="titulo_propuesta" class="form-control" value="{{ old('titulo_propuesta', $propuesta->titulo_propuesta) }}" required>
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
                        <option value="pendiente" {{ old('estatus', $propuesta->estatus) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                        <option value="en revision" {{ old('estatus', $propuesta->estatus) == 'en revision' ? 'selected' : '' }}>En revisión</option>
                        <option value="aprobada" {{ old('estatus', $propuesta->estatus) == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                        <option value="rechazada" {{ old('estatus', $propuesta->estatus) == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', $propuesta->fecha_ingreso ? \Carbon\Carbon::parse($propuesta->fecha_ingreso)->toDateString() : '') }}" required>
                </div>

                <div class="form-group">
                    <label>Archivo de Propuesta (PDF)</label>
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
