{{-- resources/views/admin/servicio_comunitario/edit.blade.php --}}
<x-admin>
    @section('title', 'Editar Servicio Comunitario')

    @section('content_header')
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Editar Servicio Comunitario</h1>
        </div>
    @endsection

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong><i class="fas fa-triangle-exclamation me-2"></i>Por favor corrige los errores:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.servicio_comunitario.update', $servicio->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Datos del Estudiante</h5>
            </div>
        <div class="card-body">
            <div class="form-group mb-3">
                <label class="form-label">Nombre </label>
                <input type="text" name="nombre_estudiante"
                        value="{{ old('nombre_estudiante', $servicio->nombre_estudiante) }}"
                        class="form-control @error('nombre_estudiante') is-invalid @enderror">
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Apellido </label>
                <input type="text" name="apellido_estudiante"
                        value="{{ old('apellido_estudiante', $servicio->apellido_estudiante) }}"
                        class="form-control @error('apellido_estudiante') is-invalid @enderror">
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Cédula </label>
                <input type="text" name="cedula"
                        value="{{ old('cedula', $servicio->cedula) }}"
                        class="form-control @error('cedula') is-invalid @enderror">
            </div>

            <div class="form-group mb-3">
                <label class="form-label">Carrera</label>
                <input type="text" name="carrera"
                        value="{{ old('carrera', $servicio->carrera) }}"
                        class="form-control @error('carrera') is-invalid @enderror">
            </div>
            </div>
        </div>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Título del servicio </label>
                    <input type="text" name="titulo_servicio"
                            value="{{ old('titulo_servicio', $servicio->titulo_servicio) }}"
                            class="form-control @error('titulo_servicio') is-invalid @enderror">
                </div>

                <div class="mb-3">
                    <label class="form-label">Trabajo / archivo (PDF)</label>
                    <input type="file" name="trabajo_servicio"
                            accept="application/pdf"
                            class="form-control @error('trabajo_servicio') is-invalid @enderror">
                    <small class="text-muted">Si seleccionas un nuevo archivo reemplazará al existente.</small>

                    @if($servicio->trabajo_servicio)
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $servicio->trabajo_servicio) }}" target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-file-pdf me-1"></i>Ver archivo actual
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Docente Asignado</label>
                    <select name="docente_id"
                            class="form-control @error('docente_id') is-invalid @enderror">
                        @foreach($docentes as $doc)
                            <option value="{{ $doc->id }}"
                                {{ old('docente_id', $servicio->docente_id) == $doc->id ? 'selected' : '' }}>
                                {{ $doc->nombre }} {{ $doc->apellido }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Estado</label>
                    <select name="estatus"
                                class="form-control @error('estatus') is-invalid @enderror"
                                required>
                            @php
                                $estatuses = ['pendiente','proceso', 'aprobado', 'rechazado'];
                            @endphp
                            @foreach ($estatuses as $st)
                                <option value="{{ $st }}"
                                        {{ old('estatus', 'Pendiente') == $st ? 'selected' : '' }}>
                                    {{ $st }}
                                </option>
                            @endforeach
                        </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fecha de ingreso</label>
                    <input type="date" name="fecha_ingreso"
                            value="{{ old('fecha_ingreso', \Carbon\Carbon::parse($servicio->fecha_ingreso)->format('Y-m-d')) }}"
                            class="form-control @error('fecha_ingreso') is-invalid @enderror">
                </div>
            </div>

            <div class="card-footer d-flex justify-content-between">
                <a href="{{ route('admin.servicio_comunitario.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
                <button class="btn btn-primary">
                    Actualizar
                </button>
            </div>
        </div>
    </form>
</x-admin>
