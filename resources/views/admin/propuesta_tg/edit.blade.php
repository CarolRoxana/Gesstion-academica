<x-admin>
    @section('title', 'Editar Propuesta TG')
    <div class="card">
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
            <form action="{{ route('admin.propuesta_tg.update', $propuesta->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Primer tesista (siempre visible) -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Datos del Tesista 1</h5>
                    </div>
                    <div class="card-body">
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
                                    <option value="{{ $carrera->id }}" {{ old('carrera', $propuesta->carrera) == $carrera->nombre ? 'selected' : '' }}>
                                        {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Segundo tesista (visible solo si existe) -->
                <div id="tesista2-container" class="card mb-4" style="{{ (old('nombre_tesista2', $propuesta->nombre_tesista2) || old('apellido_tesista2', $propuesta->apellido_tesista2) || old('cedula2', $propuesta->cedula2) || old('carrera2', $propuesta->carrera2)) ? 'display: block;' : 'display: none;' }}">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Datos del Tesista 2</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre del Tesista 2</label>
                            <input type="text" name="nombre_tesista2" class="form-control" value="{{ old('nombre_tesista2', $propuesta->nombre_tesista2) }}">
                        </div>

                        <div class="form-group">
                            <label>Apellido del Tesista 2</label>
                            <input type="text" name="apellido_tesista2" class="form-control" value="{{ old('apellido_tesista2', $propuesta->apellido_tesista2) }}">
                        </div>

                        <div class="form-group">
                            <label>Cédula del Tesista 2</label>
                            <input type="text" name="cedula2" class="form-control" value="{{ old('cedula2', $propuesta->cedula2) }}">
                        </div>

                        <div class="form-group">
                            <label>Carrera del Tesista 2</label>
                            <select name="carrera2" class="form-control">
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}" {{ old('carrera2', $propuesta->carrera2) == $carrera->nombre ? 'selected' : '' }}>
                                        {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tercer tesista (visible solo si existe) -->
                <div id="tesista3-container" class="card mb-4" style="{{ (old('nombre_tesista3', $propuesta->nombre_tesista3) || old('apellido_tesista3', $propuesta->apellido_tesista3) || old('cedula3', $propuesta->cedula3) || old('carrera3', $propuesta->carrera3)) ? 'display: block;' : 'display: none;' }}">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Datos del Tesista 3</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre del Tesista 3</label>
                            <input type="text" name="nombre_tesista3" class="form-control" value="{{ old('nombre_tesista3', $propuesta->nombre_tesista3) }}">
                        </div>

                        <div class="form-group">
                            <label>Apellido del Tesista 3</label>
                            <input type="text" name="apellido_tesista3" class="form-control" value="{{ old('apellido_tesista3', $propuesta->apellido_tesista3) }}">
                        </div>

                        <div class="form-group">
                            <label>Cédula del Tesista 3</label>
                            <input type="text" name="cedula3" class="form-control" value="{{ old('cedula3', $propuesta->cedula3) }}">
                        </div>

                        <div class="form-group">
                            <label>Carrera del Tesista 3</label>
                            <select name="carrera3" class="form-control">
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}" {{ old('carrera3', $propuesta->carrera3) == $carrera->nombre ? 'selected' : '' }}>
                                        {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Botón para agregar otro tesista -->
                <div class="text-center mb-4" id="btn-container">
                    <button type="button" id="btn-agregar-tesista" class="btn btn-primary" 
                    {{ ((old('nombre_tesista3', $propuesta->nombre_tesista3) || old('apellido_tesista3', $propuesta->apellido_tesista3) || old('cedula3', $propuesta->cedula3) || old('carrera3', $propuesta->carrera3))) ? 'style=display:none' : '' }}>
                        <i class="fas fa-user-plus"></i> Agregar otro tesista
                    </button>
                </div>

                <!-- Información de la propuesta -->
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Información de la Propuesta</h5>
                    </div>
                    <div class="card-body">
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
                                <div class="mt-2">
                                    <a href="{{ asset('storage/' . $propuesta->propuesta) }}" target="_blank" class="btn btn-info">
                                        <i class="fas fa-file-pdf"></i> Ver PDF Actual
                                    </a>
                                    <small class="text-muted ml-2">Sube un nuevo archivo solo si deseas reemplazar el actual</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                         Actualizar Propuesta
                    </button>
                    <a href="{{ route('admin.propuesta_tg.index') }}" class="btn btn-secondary btn-lg ml-2">
                        </i> Volver
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para manejar la adición de tesistas -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btnAgregarTesista = document.getElementById('btn-agregar-tesista');
            const tesista2Container = document.getElementById('tesista2-container');
            const tesista3Container = document.getElementById('tesista3-container');
            
            // Determinar cuántos tesistas ya están mostrados
            let tesistasAgregados = 0;
            
            if (tesista2Container.style.display === 'block') {
                tesistasAgregados = 1;
            }
            
            if (tesista3Container.style.display === 'block') {
                tesistasAgregados = 2;
                btnAgregarTesista.style.display = 'none'; // Ya hay 3 tesistas, ocultar botón
            }

            btnAgregarTesista.addEventListener('click', function() {
                tesistasAgregados++;
                
                if (tesistasAgregados === 1) {
                    tesista2Container.style.display = 'block';
                } else if (tesistasAgregados === 2) {
                    tesista3Container.style.display = 'block';
                    btnAgregarTesista.style.display = 'none'; // Ocultar el botón después de agregar el tercer tesista
                }
            });
            
            // Manejar la eliminación de tesistas
            const tesistaFields = document.querySelectorAll('input[name^="nombre_tesista"], input[name^="apellido_tesista"], input[name^="cedula"], select[name^="carrera"]');
            
            tesistaFields.forEach(field => {
                // Solo para campos de tesista 2 y 3
                if (field.name.includes('2') || field.name.includes('3')) {
                    field.addEventListener('input', function() {
                        // Si todos los campos de un tesista están vacíos, podríamos ocultar esa sección
                        // Pero dejamos que el backend maneje la validación
                    });
                }
            });
        });
    </script>
</x-admin>