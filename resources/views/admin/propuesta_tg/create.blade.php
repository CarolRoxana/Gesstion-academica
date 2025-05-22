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
                {{-- ====== TESISTA 1 (siempre visible) ====== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Datos del Tesista 1</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label>Nombre</label>
                            <input type="text" name="nombre_tesista" class="form-control"
                                   value="{{ old('nombre_tesista') }}" required>
                        </div>

                        <div class="form-group mb-2">
                            <label>Apellido</label>
                            <input type="text" name="apellido_tesista" class="form-control"
                                   value="{{ old('apellido_tesista') }}" required>
                        </div>

                        <div class="form-group mb-2">
                            <label>Cédula</label>
                            <input type="text" name="cedula" class="form-control"
                                   value="{{ old('cedula') }}" required>
                        </div>

                        <div class="form-group">
                            <label>Carrera</label>
                            <select name="carrera" class="form-control" required>
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}" @selected(old('carrera')==$carrera->nombre)>{{ $carrera->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                 {{-- ====== TESISTA 2 (oculto al inicio) ====== --}}
                <div id="tesista2-card" class="card mb-4" style="display:none;">
                    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Datos del Tesista 2</h5>
                        <button type="button" class="btn-close bg-white" id="hide-tesista2"></button>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label>Nombre</label>
                            <input type="text" name="nombre_tesista2" class="form-control"
                                   value="{{ old('nombre_tesista2') }}">
                        </div>

                        <div class="form-group mb-2">
                            <label>Apellido</label>
                            <input type="text" name="apellido_tesista2" class="form-control"
                                   value="{{ old('apellido_tesista2') }}">
                        </div>

                        <div class="form-group mb-2">
                            <label>Cédula</label>
                            <input type="text" name="cedula2" class="form-control"
                                   value="{{ old('cedula2') }}">
                        </div>

                        <div class="form-group">
                            <label>Carrera</label>
                            <select name="carrera2" class="form-control">
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}" @selected(old('carrera2')==$carrera->nombre)>{{ $carrera->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- ====== TESISTA 3 (oculto al inicio) ====== --}}
                <div id="tesista3-card" class="card mb-4" style="display:none;">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Datos del Tesista 3</h5>
                        <button type="button" class="btn-close bg-white" id="hide-tesista3"></button>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label>Nombre</label>
                            <input type="text" name="nombre_tesista3" class="form-control"
                                   value="{{ old('nombre_tesista3') }}">
                        </div>

                        <div class="form-group mb-2">
                            <label>Apellido</label>
                            <input type="text" name="apellido_tesista3" class="form-control"
                                   value="{{ old('apellido_tesista3') }}">
                        </div>

                        <div class="form-group mb-2">
                            <label>Cédula</label>
                            <input type="text" name="cedula3" class="form-control"
                                   value="{{ old('cedula3') }}">
                        </div>

                        <div class="form-group">
                            <label>Carrera</label>
                            <select name="carrera3" class="form-control">
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}" @selected(old('carrera3')==$carrera->nombre)>{{ $carrera->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Botón para agregar tesistas --}}
                <div class="text-center mb-4">
                    <button type="button" id="add-tesista-btn" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Agregar otro tesista
                    </button>
                </div>

                <div class="form-group">
                    <label>Título de la Propuesta</label>
                    <input type="text" name="titulo_propuesta" class="form-control" value="{{ old('titulo_propuesta') }}" required>
                </div>

                <div class="form-group">
                    <label>Docente Asignado</label>
                    <select name="docente_id" class="form-control" required>
                        <option value="">Seleccione un docente</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->nombre }} {{ $docente->apellido }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Estatus</label>
                    <select name="estatus" class="form-control" required>
                        <option value="proceso">Proceso</option>
                        <option value="pendiente">Pendiente</option>
                        <option value="aprobada">Aprobada</option>
                        <option value="rechazada">Rechazada</option>
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

                <button type="submit" class="btn btn-success mt-3">Guardar</button>
            </form>

        </div>
    </div>

   {{-- ====== SCRIPTS ====== --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addBtn   = document.getElementById('add-tesista-btn');
            const card2    = document.getElementById('tesista2-card');
            const card3    = document.getElementById('tesista3-card');
            const hide2    = document.getElementById('hide-tesista2');
            const hide3    = document.getElementById('hide-tesista3');
            let   visibles = 0;

            // Restaurar estado si hubo errores
            @if (old('nombre_tesista2') || old('apellido_tesista2') || old('cedula2') || old('carrera2'))
                card2.style.display = 'block'; visibles = 1;
            @endif
            @if (old('nombre_tesista3') || old('apellido_tesista3') || old('cedula3') || old('carrera3'))
                card2.style.display = 'block'; card3.style.display = 'block'; visibles = 2; addBtn.style.display='none';
            @endif

            addBtn.addEventListener('click', () => {
                visibles++;
                if (visibles === 1) {
                    card2.style.display = 'block';
                } else if (visibles === 2) {
                    card3.style.display = 'block';
                    addBtn.style.display = 'none';
                }
            });

            hide2.addEventListener('click', () => {
                card2.style.display = 'none';
                visibles--; if (addBtn.style.display === 'none') addBtn.style.display='';
                // Limpiar campos
                card2.querySelectorAll('input,select').forEach(el => el.value='');
            });

            hide3.addEventListener('click', () => {
                card3.style.display = 'none';
                visibles--;
                addBtn.style.display='';
                card3.querySelectorAll('input,select').forEach(el => el.value='');
            });
        });
    </script>
</x-admin>
