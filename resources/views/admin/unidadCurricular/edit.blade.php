<x-admin>
    @section('title', 'Editar Unidad Curricular')

    <form action="{{ route('admin.unidad_curricular.update', $unidad_curricular->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $unidad_curricular->nombre }}" required>
        </div>

        <div class="form-group">
            <label>Unidad Curricular</label>
            <input type="number" name="unidad_curricular" class="form-control" value="{{ $unidad_curricular->unidad_curricular }}" required>
        </div>

        <div class="form-group">
            <label>Carrera</label>
            <input type="text" name="carrera" class="form-control" value="{{ $unidad_curricular->carrera }}" required>
        </div>

        <div class="form-group">
            <label>Semestre</label>
            <input type="text" name="semestre" class="form-control" value="{{ $unidad_curricular->semestre }}" required>
        </div>

        <div class="form-group">
            <label>Docente</label>
            <select name="docente_id" class="form-control" required>
                @foreach($docentes as $docente)
                    <option value="{{ $docente->id }}" {{ $unidad_curricular->docente_id == $docente->id ? 'selected' : '' }}>
                        {{ $docente->nombre }} {{ $docente->apellido ?? '' }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Actualizar</button>
    </form>
</x-admin>
