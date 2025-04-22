<x-admin>
    @section('title', 'Editar Licencia Docente')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('licencia_docentes.update', $licencia_docente->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="id_user" class="form-label">Docente</label>
                    <select name="id_user" id="id_user" class="form-control">
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('id_user', $licencia->id_user ?? '') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="nombre_curso" class="form-label">Nombre del Curso</label>
                    <input type="text" name="nombre_curso" id="nombre_curso" class="form-control" value="{{ old('nombre_curso', $licencia->nombre_curso ?? '') }}">
                </div>
                
                <div class="mb-3">
                    <label for="institucion" class="form-label">Institución</label>
                    <input type="text" name="institucion" id="institucion" class="form-control" value="{{ old('institucion', $licencia->institucion ?? '') }}">
                </div>
                
                <div class="mb-3">
                    <label for="tipo_curso" class="form-label">Tipo de Curso</label>
                    <input type="text" name="tipo_curso" id="tipo_curso" class="form-control" value="{{ old('tipo_curso', $licencia->tipo_curso ?? '') }}">
                </div>
                
                <div class="mb-3">
                    <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', $licencia->fecha_inicio ?? '') }}">
                </div>
                
                <div class="mb-3">
                    <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" value="{{ old('fecha_fin', $licencia->fecha_fin ?? '') }}">
                </div>
                
                <div class="mb-3">
                    <label for="estatus" class="form-label">Estatus</label>
                    <input type="text" name="estatus" id="estatus" class="form-control" value="{{ old('estatus', $licencia->estatus ?? '') }}">
                </div>
                

                <button type="submit" class="btn btn-success mt-3">Actualizar</button>
            </form>
        </div>
    </div>
</x-admin>
