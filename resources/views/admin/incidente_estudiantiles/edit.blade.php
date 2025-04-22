<x-admin>
    @section('title', 'Editar Incidente Estudiantil')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.incidente-estudiantil.update', $incidente_estudiantil) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-3">
                    <label for="docente_id" class="form-label">Docente</label>
                    <select name="docente_id" class="form-control">
                        @foreach ($docentes as $docente)
                            <option value="{{ $docente->id }}" {{ old('docente_id', $incidente->docente_id ?? '') == $docente->id ? 'selected' : '' }}>
                                {{ $docente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                @foreach (['nombre', 'apellido', 'cedula', 'carrera', 'semestre', 'incidente'] as $field)
                    <div class="mb-3">
                        <label for="{{ $field }}" class="form-label">{{ ucfirst($field) }}</label>
                        <input type="text" name="{{ $field }}" class="form-control" value="{{  $incidente_estudiantil->$field }}">
                    </div>
                @endforeach
                
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" class="form-control"> value="{{ ( $incidente_estudiantil->descripcion) }}"</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="fecha_incidente" class="form-label">Fecha del Incidente</label>
                    <input type="datetime-local" name="fecha_incidente" class="form-control" value="{{ $incidente_estudiantil->fecha_incidente}}">
                </div>
                
                <button type="submit" class="btn btn-success mt-3">Actualizar</button>
            </form>
        </div>
    </div>
</x-admin>
