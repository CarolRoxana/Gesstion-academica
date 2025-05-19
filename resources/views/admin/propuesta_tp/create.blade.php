<x-admin>
    @section('title', 'Crear Propuesta TP')

    <div class="card">
        <div class="card-body">
            {{-- Errores de validación --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.propuesta_tp.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- ====== PASANTE 1 (siempre visible) ====== --}}
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Datos del Pasante 1</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label>Nombre</label>
                            <input type="text" name="nombre_pasante" class="form-control"
                                   value="{{ old('nombre_pasante') }}" required>
                        </div>

                        <div class="form-group mb-2">
                            <label>Apellido</label>
                            <input type="text" name="apellido_pasante" class="form-control"
                                   value="{{ old('apellido_pasante') }}" required>
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
                                    <option value="{{ $carrera }}" @selected(old('carrera')==$carrera)>{{ $carrera }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- ====== PASANTE 2 (oculto al inicio) ====== --}}
                <div id="pasante2-card" class="card mb-4" style="display:none;">
                    <div class="card-header bg-secondary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Datos del Pasante 2</h5>
                        <button type="button" class="btn-close bg-white" id="hide-pasante2"></button>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label>Nombre</label>
                            <input type="text" name="nombre_pasante2" class="form-control"
                                   value="{{ old('nombre_pasante2') }}">
                        </div>

                        <div class="form-group mb-2">
                            <label>Apellido</label>
                            <input type="text" name="apellido_pasante2" class="form-control"
                                   value="{{ old('apellido_pasante2') }}">
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
                                    <option value="{{ $carrera }}" @selected(old('carrera2')==$carrera)>{{ $carrera }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- ====== PASANTE 3 (oculto al inicio) ====== --}}
                <div id="pasante3-card" class="card mb-4" style="display:none;">
                    <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Datos del Pasante 3</h5>
                        <button type="button" class="btn-close bg-white" id="hide-pasante3"></button>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-2">
                            <label>Nombre</label>
                            <input type="text" name="nombre_pasante3" class="form-control"
                                   value="{{ old('nombre_pasante3') }}">
                        </div>

                        <div class="form-group mb-2">
                            <label>Apellido</label>
                            <input type="text" name="apellido_pasante3" class="form-control"
                                   value="{{ old('apellido_pasante3') }}">
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
                                    <option value="{{ $carrera }}" @selected(old('carrera3')==$carrera)>{{ $carrera }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Botón para agregar tesistas --}}
                <div class="text-center mb-4">
                    <button type="button" id="add-tesista-btn" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Agregar otro pasante
                    </button>
                </div>

                {{-- ====== INFO GENERAL DE LA PROPUESTA ====== --}}
                <div class="card mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Información de la Propuesta</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group mb-3">
                            <label>Título de la Propuesta</label>
                            <input type="text" name="titulo_propuesta" class="form-control"
                                   value="{{ old('titulo_propuesta') }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label>Docente Asignado</label>
                            <select name="docente_id" class="form-control" required>
                                <option value="">Seleccione un docente</option>
                                @foreach ($docentes as $docente)
                                    <option value="{{ $docente->id }}" @selected(old('docente_id')==$docente->id)>
                                        {{ $docente->apellido }}, {{ $docente->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Estatus</label>
                            <select name="estatus" class="form-control" required>
                                <option value="proceso"   @selected(old('estatus')=='proceso')>Proceso</option>
                                <option value="pendiente" @selected(old('estatus')=='pendiente')>Pendiente</option>
                                <option value="aprobada"  @selected(old('estatus')=='aprobada')>Aprobada</option>
                                <option value="rechazada" @selected(old('estatus')=='rechazada')>Rechazada</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label>Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" class="form-control"
                                   value="{{ old('fecha_ingreso') ?? now()->toDateString() }}" required>
                        </div>

                        <div class="form-group">
                            <label>Plan de Trabajo (PDF)</label>
                            <input type="file" name="plan_trabajo" class="form-control" accept="application/pdf" required>
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

    {{-- ====== SCRIPTS ====== --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const addBtn   = document.getElementById('add-tesista-btn');
            const card2    = document.getElementById('pasante2-card');
            const card3    = document.getElementById('pasante3-card');
            const hide2    = document.getElementById('hide-pasante2');
            const hide3    = document.getElementById('hide-pasante3');
            let   visibles = 0;

            // Restaurar estado si hubo errores
            @if (old('nombre_pasante2') || old('apellido_pasante2') || old('cedula2') || old('carrera2'))
                card2.style.display = 'block'; visibles = 1;
            @endif
            @if (old('nombre_pasante3') || old('apellido_pasante3') || old('cedula3') || old('carrera3'))
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
