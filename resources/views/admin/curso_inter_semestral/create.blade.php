<x-admin>
    @section('title', 'Crear Curso Intersemestral')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.curso-inter-semestral.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Docente</label>
                    <select name="docente_id" class="form-control" required>
                        <option value="">Seleccione</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->nombre }} {{ $docente->apellido }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Nombre del curso</label>
                    <input type="text" name="nombre_curso" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label>Modalidad</label>
                    <input type="text" name="modalidad" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Fecha Inicio</label>
                    <input type="datetime-local" name="fecha_inicio" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Fecha Fin</label>
                    <input type="datetime-local" name="fecha_fin" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Cupos Máximos</label>
                    <input type="number" name="cupos_max" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Estatus</label>
                    <input type="text" name="estatus" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Exponente (opcional)</label>
                    <input type="text" name="exponente" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
</x-admin>
