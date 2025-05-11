<x-admin>
    @section('title', 'Editar Curso Intersemestral')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.curso-inter-semestral.update', $curso_inter_semestral->id) }}" method="POST">
                @csrf
                @method('PUT')
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
                    <input type="text" name="nombre_curso" class="form-control" value="{{ old('nombre_curso', $curso_inter_semestral->nombre_curso) }}"required>
                </div>

                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control" value="{{ old('descripcion', $curso_inter_semestral->descripcion) }}" required></textarea>
                </div>

                <div class="form-group">
                    <label>Modalidad</label>
                    <input type="text" name="modalidad" class="form-control" value="{{ old('modalidad', $curso_inter_semestral->modalidad) }}" required>
                </div>

                <div class="form-group">
                    <label>Fecha Inicio</label>
                    <input type="datetime-local" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicial', $curso_inter_semestral->fecha_inicial) }}" required>
                </div>

                <div class="form-group">
                    <label>Fecha Fin</label>
                    <input type="datetime-local" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', $curso_inter_semestral->fecha_fin) }}" required>
                </div>

                <div class="form-group">
                    <label>Cupos Máximos</label>
                    <input type="number" name="cupos_max" class="form-control" value="{{ old('cupos_max', $curso_inter_semestral->cupos_max) }}" required>
                </div>

                <div class="form-group">
                    <label>Estatus</label>
                    <input type="text" name="estatus" class="form-control" value="{{ old('estatus', $curso_inter_semestral->estatus) }}" required>
                </div>

                <div class="form-group">
                    <label>Exponente (opcional)</label>
                    <input type="text" name="exponente" class="form-control" value="{{ old('exponente', $curso_inter_semestral->exponente) }}">
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
</x-admin>
