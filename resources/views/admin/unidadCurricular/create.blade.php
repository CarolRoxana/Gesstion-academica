<x-admin>
    @section('title', 'Crear Unidad Curricular')

    <form action="{{ route('admin.unidad-curricular.index') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Unidad Curricular (número o código)</label>
            <input type="number" name="unidad_curricular" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Carrera</label>
            <input type="text" name="carrera" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Semestre</label>
            <input type="text" name="semestre" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Docente</label>
            <select name="docente_id" class="form-control" required>
                <option value="">Seleccione</option>
                @foreach($docentes as $docente)
                    <option value="{{ $docente->id }}">{{ $docente->nombre }} {{ $docente->apellido ?? '' }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-primary">Guardar</button>
    </form>
</x-admin>
