<x-admin>
    @section('title', 'Crear Propuesta TG')
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
            <form action="{{ route('admin.propuesta_tg.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Primer tesista (siempre visible) -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Datos del Tesista 1</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre del Tesista</label>
                            <input type="text" name="nombre_tesista" class="form-control" value="{{ old('nombre_tesista') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Apellido del Tesista</label>
                            <input type="text" name="apellido_tesista" class="form-control" value="{{ old('apellido_tesista') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Cédula</label>
                            <input type="text" name="cedula" class="form-control" value="{{ old('cedula') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Carrera</label>
                            <select name="carrera" class="form-control" required>
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera }}" {{ old('carrera') == $carrera ? 'selected' : '' }}>{{ $carrera }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Segundo tesista (inicialmente oculto) -->
                <div id="tesista2-container" class="card mb-4" style="display: none;">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Datos del Tesista 2</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre del Tesista 2</label>
                            <input type="text" name="nombre_tesista2" class="form-control" value="{{ old('nombre_tesista2') }}">
                        </div>

                        <div class="form-group">
                            <label>Apellido del Tesista 2</label>
                            <input type="text" name="apellido_tesista2" class="form-control" value="{{ old('apellido_tesista2') }}">
                        </div>

                        <div class="form-group">
                            <label>Cédula del Tesista 2</label>
                            <input type="text" name="cedula2" class="form-control" value="{{ old('cedula2') }}">
                        </div>

                        <div class="form-group">
                            <label>Carrera del Tesista 2</label>
                            <select name="carrera2" class="form-control">
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera }}" {{ old('carrera2') == $carrera ? 'selected' : '' }}>{{ $carrera }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tercer tesista (inicialmente oculto) -->
                <div id="tesista3-container" class="card mb-4" style="display: none;">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Datos del Tesista 3</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre del Tesista 3</label>
                            <input type="text" name="nombre_tesista3" class="form-control" value="{{ old('nombre_tesista3') }}">
                        </div>

                        <div class="form-group">
                            <label>Apellido del Tesista 3</label>
                            <input type="text" name="apellido_tesista3" class="form-control" value="{{ old('apellido_tesista3') }}">
                        </div>

                        <div class="form-group">
                            <label>Cédula del Tesista 3</label>
                            <input type="text" name="cedula3" class="form-control" value="{{ old('cedula3') }}">
                        </div>

                        <div class="form-group">
                            <label>Carrera del Tesista 3</label>
                            <select name="carrera3" class="form-control">
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera }}" {{ old('carrera3') == $carrera ? 'selected' : '' }}>{{ $carrera }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Botón para agregar otro tesista -->
                <div class="text-center mb-4">
                    <button type="button" id="btn-agregar-tesista" class="btn btn-primary">
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
                            <input type="text" name="titulo_propuesta" class="form-control" value="{{ old('titulo_propuesta') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Docente Asignado</label>
                            <select name="docente_id" class="form-control" required>
                                <option value="">Seleccione un docente</option>
                                @foreach($docentes as $docente)
                                    <option value="{{ $docente->id }}" {{ old('docente_id') == $docente->id ? 'selected' : '' }}>
                                        {{ $docente->nombre }} {{ $docente->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Estatus</label>
                            <select name="estatus" class="form-control" required>
                                <option value="pendiente" {{ old('estatus') == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="aprobada" {{ old('estatus') == 'aprobada' ? 'selected' : '' }}>Aprobada</option>
                                <option value="rechazada" {{ old('estatus') == 'rechazada' ? 'selected' : '' }}>Rechazada</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso') ?? now()->toDateString() }}" required>
                        </div>

                        <div class="form-group">
                            <label>Archivo de Propuesta (PDF)</label>
                            <input type="file" name="propuesta" class="form-control" accept="application/pdf" required>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fas fa-save"></i> Guardar Propuesta
                    </button>
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
            let tesistasAgregados = 0;

            // Si hay valores antiguos (por ejemplo, después de un error de validación), 
            // restaurar el estado adecuado
            if ("{{ old('nombre_tesista2') }}" || "{{ old('apellido_tesista2') }}" || 
                "{{ old('cedula2') }}" || "{{ old('carrera2') }}") {
                tesista2Container.style.display = 'block';
                tesistasAgregados = 1;
            }
            
            if ("{{ old('nombre_tesista3') }}" || "{{ old('apellido_tesista3') }}" || 
                "{{ old('cedula3') }}" || "{{ old('carrera3') }}") {
                tesista3Container.style.display = 'block';
                tesistasAgregados = 2;
                btnAgregarTesista.style.display = 'none';
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
        });
    </script>
</x-admin>