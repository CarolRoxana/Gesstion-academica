<x-admin>
    @section('title', 'Editar Propuesta TP')

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.propuesta_tp.update', $propuesta->id) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Datos del Pasante 1</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre_pasante" class="form-control"
                                   value="{{ old('nombre_pasante', $propuesta->nombre_pasante) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Apellido</label>
                            <input type="text" name="apellido_pasante" class="form-control"
                                   value="{{ old('apellido_pasante', $propuesta->apellido_pasante) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Cédula</label>
                            <input type="text" name="cedula" class="form-control"
                                   value="{{ old('cedula', $propuesta->cedula) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Carrera</label>
                            <select name="carrera" class="form-control" required>
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}"
                                        {{ old('carrera', $propuesta->carrera)==$carrera->nombre ? 'selected' : '' }}>
                                        {{ $carrera->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div id="pasante2-container" class="card mb-4"
                     style="{{ (old('nombre_pasante2',$propuesta->nombre_pasante2)||old('apellido_pasante2',$propuesta->apellido_pasante2)||old('cedula2',$propuesta->cedula2)||old('carrera2',$propuesta->carrera2)) ? 'display:block;' : 'display:none;' }}">
                    <div class="card-header bg-secondary text-white">
                        <h5 class="mb-0">Datos del Pasante 2</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre del Pasante 2</label>
                            <input type="text" name="nombre_pasante2" class="form-control"
                                   value="{{ old('nombre_pasante2', $propuesta->nombre_pasante2) }}">
                        </div>

                        <div class="form-group">
                            <label>Apellido del Pasante 2</label>
                            <input type="text" name="apellido_pasante2" class="form-control"
                                   value="{{ old('apellido_pasante2', $propuesta->apellido_pasante2) }}">
                        </div>

                        <div class="form-group">
                            <label>Cédula del Pasante 2</label>
                            <input type="text" name="cedula2" class="form-control"
                                   value="{{ old('cedula2', $propuesta->cedula2) }}">
                        </div>

                        <div class="form-group">
                            <label>Carrera del Pasante 2</label>
                            <select name="carrera2" class="form-control">
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id}}"
                                        {{ old('carrera2', $propuesta->carrera2)==$carrera->nombre ? 'selected' : '' }}>
                                        {{ $carrera->nombre}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div id="pasante3-container" class="card mb-4"
                     style="{{ (old('nombre_pasante3',$propuesta->nombre_pasante3)||old('apellido_pasante3',$propuesta->apellido_pasante3)||old('cedula3',$propuesta->cedula3)||old('carrera3',$propuesta->carrera3)) ? 'display:block;' : 'display:none;' }}">
                    <div class="card-header bg-info text-white">
                        <h5 class="mb-0">Datos del Pasante 3</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nombre del Pasante 3</label>
                            <input type="text" name="nombre_pasante3" class="form-control"
                                   value="{{ old('nombre_pasante3', $propuesta->nombre_pasante3) }}">
                        </div>

                        <div class="form-group">
                            <label>Apellido del Pasante 3</label>
                            <input type="text" name="apellido_pasante3" class="form-control"
                                   value="{{ old('apellido_pasante3', $propuesta->apellido_pasante3) }}">
                        </div>

                        <div class="form-group">
                            <label>Cédula del Pasante 3</label>
                            <input type="text" name="cedula3" class="form-control"
                                   value="{{ old('cedula3', $propuesta->cedula3) }}">
                        </div>

                        <div class="form-group">
                            <label>Carrera del Pasante 3</label>
                            <select name="carrera3" class="form-control">
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera->id }}"
                                        {{ old('carrera3', $propuesta->carrera3)==$carrera->nombre ? 'selected' : '' }}>
                                        {{ $carrera->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="text-center mb-4" id="btn-container">
                    <button type="button" id="btn-agregar-pasante" class="btn btn-primary"
                        {{ (old('nombre_pasante3',$propuesta->nombre_pasante3)||old('apellido_pasante3',$propuesta->apellido_pasante3)||old('cedula3',$propuesta->cedula3)||old('carrera3',$propuesta->carrera3)) ? 'style=display:none;' : '' }}>
                        <i class="fas fa-user-plus"></i> Agregar otro pasante
                    </button>
                </div>

                <div class="card mb-4">
                    <div class="card-header bg-dark text-white">
                        <h5 class="mb-0">Información de la Propuesta</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Título de la Propuesta</label>
                            <input type="text" name="titulo_propuesta" class="form-control"
                                   value="{{ old('titulo_propuesta', $propuesta->titulo_propuesta) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Docente Asignado</label>
                            <select name="docente_id" class="form-control" required>
                                <option value="">Seleccione un docente</option>
                                @foreach($docentes as $docente)
                                    <option value="{{ $docente->id }}"
                                        {{ old('docente_id', $propuesta->docente_id)==$docente->id ? 'selected' : '' }}>
                                        {{ $docente->nombre }} {{ $docente->apellido }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Estatus</label>
                            <select name="estatus" class="form-control" required>
                                <option value="pendiente"  {{ old('estatus',$propuesta->estatus)=='pendiente'  ? 'selected' : '' }}>Pendiente</option>
                                <option value="proceso"    {{ old('estatus',$propuesta->estatus)=='proceso'    ? 'selected' : '' }}>En proceso</option>
                                <option value="aprobada"   {{ old('estatus',$propuesta->estatus)=='aprobada'   ? 'selected' : '' }}>Aprobada</option>
                                <option value="rechazada"  {{ old('estatus',$propuesta->estatus)=='rechazada'  ? 'selected' : '' }}>Rechazada</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Fecha de Ingreso</label>
                            <input type="date" name="fecha_ingreso" class="form-control"
                                   value="{{ old('fecha_ingreso', optional($propuesta->fecha_ingreso)->toDateString()) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Archivo de Propuesta (PDF)</label>
                            <input type="file" name="plan_trabajo" class="form-control" accept="application/pdf">
                            @if($propuesta->plan_trabajo)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/'.$propuesta->plan_trabajo) }}" target="_blank" class="btn btn-info">
                                         Ver PDF Actual
                                    </a>
                                    <small class="text-muted ml-2">Sube uno nuevo solo si deseas reemplazarlo</small>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg">
                         Actualizar Propuesta
                    </button>
                    <a href="{{ route('admin.propuesta_tp.index') }}" class="btn btn-secondary btn-lg ml-2">
                         Volver
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btnAdd     = document.getElementById('btn-agregar-pasante');
            const cont2      = document.getElementById('pasante2-container');
            const cont3      = document.getElementById('pasante3-container');

            let visibles = (cont2.style.display === 'block') + (cont3.style.display === 'block');

            btnAdd?.addEventListener('click', () => {
                visibles++;
                if (visibles === 1) cont2.style.display = 'block';
                else if (visibles === 2) { cont3.style.display = 'block'; btnAdd.style.display = 'none'; }
            });
        });
    </script>
</x-admin>
