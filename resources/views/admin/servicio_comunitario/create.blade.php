<x-admin>
    @section('title', 'Crear Servicio Comunitario')

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Nuevo Servicio Comunitario</h3>

            <a href="{{ route('admin.servicio_comunitario.index') }}"
               class="btn btn-sm btn-secondary">
                Volver
            </a>
        </div>

        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.servicio_comunitario.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <h5 class="fw-bold mb-3">Datos del estudiante</h5>

                    <div class="form-group mb-3">
                        <label class="form-label">Nombre </label>
                        <input  type="text" name="nombre_estudiante"
                                value="{{ old('nombre_estudiante') }}"
                                class="form-control @error('nombre_estudiante') is-invalid @enderror"
                                required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Apellido </label>
                        <input  type="text" name="apellido_estudiante"
                                value="{{ old('apellido_estudiante') }}"
                                class="form-control @error('apellido_estudiante') is-invalid @enderror"
                                required>
                    </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Cédula </label>
                        <input  type="text" name="cedula"
                                value="{{ old('cedula') }}"
                                class="form-control @error('cedula') is-invalid @enderror"
                                required>
                    </div>

                    <div class="form-group mb-3">
                        <label>Carrera </label>
                        <select name="carrera"
                                class="form-control @error('carrera') is-invalid @enderror"
                                required>
                            <option value="">Seleccione una carrera</option>
                            @foreach ($carreras as $c)
                                <option value="{{ $c }}"
                                        {{ old('carrera') == $c ? 'selected' : '' }}>
                                    {{ $c }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                <h5 class="fw-bold mt-4 mb-3">Información del servicio</h5>

                <div class="mb-3">
                    <label class="form-label">Título del servicio comunitario</label>
                    <input  type="text" name="titulo_servicio"
                            value="{{ old('titulo_servicio') }}"
                            class="form-control @error('titulo_servicio') is-invalid @enderror"
                            required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Archivo del trabajo (PDF) </label>
                    <input  type="file" name="trabajo_servicio"
                            accept="application/pdf"
                            class="form-control @error('trabajo_servicio') is-invalid @enderror"
                            required>
                </div>

                    <div class="form-group mb-3">
                        <label class="form-label">Docente Asignado</label>
                        <select name="docente_id"
                                class="form-control @error('docente_id') is-invalid @enderror"
                                required>
                            <option value="">Seleccione un docente</option>
                            @foreach ($docentes as $doc)
                                <option value="{{ $doc->id }}"
                                        {{ old('docente_id') == $doc->id ? 'selected' : '' }}>
                                    {{ $doc->nombre }} {{ $doc->apellido }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="from-group mb-3">
                        <label class="form-group">Estatus </label>
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
                    <label class="form-label">Fecha de ingreso </label>
                    <input  type="date" name="fecha_ingreso"
                            value="{{ old('fecha_ingreso', now()->format('Y-m-d')) }}"
                            class="form-control @error('fecha_ingreso') is-invalid @enderror"
                            required>
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    Guardar 
                </button>
            </form>
        </div>
    </div>
</x-admin>
