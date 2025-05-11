<x-admin>
    @section('title', 'Editar Unidad Curricular')

    <form action="{{ route('admin.unidad-curricular.update', $unidad_curricular->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" value="{{ $unidad_curricular->nombre }}" required>
        </div>

        <div class="form-group">
            <label>Unidad Curricular (número)</label>
            <input type="number" name="unidad_curricular" class="form-control" value="{{ $unidad_curricular->unidad_curricular }}" required>
        </div>

        <div class="form-group">
            <label for="carrera">Carrera</label>
            <select name="carrera" class="form-control" required>
                @foreach($carreras as $carrera)
                    <option value="{{ $carrera }}" {{ $unidad_curricular->carrera === $carrera ? 'selected' : '' }}>
                        {{ $carrera }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group">
            <label>Semestre</label>
            <select name="semestre" class="form-control" required>
                @for ($i = 1; $i <= 9; $i++)
                    <option value="{{ $i }}" {{ $unidad_curricular->semestre == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>

        <hr>

        <div class="form-group">
            <label>Secciones</label>
            <div id="secciones-wrapper">
                @forelse ($unidad_curricular->secciones as $seccion)
                    <div class="input-group mb-2">
                        <input type="text" name="secciones[]" class="form-control" value="{{ $seccion->nombre }}" required>
                        <button type="button" class="btn btn-danger remove-seccion">Eliminar</button>
                    </div>
                @empty
                    <div class="input-group mb-2">
                        <input type="text" name="secciones[]" class="form-control" placeholder="Ej: 1" required>
                        <button type="button" class="btn btn-danger remove-seccion">Eliminar</button>
                    </div>
                @endforelse
            </div>
            <button type="button" class="btn btn-secondary mt-2" id="add-seccion">Agregar Sección</button>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const wrapper = document.getElementById('secciones-wrapper');
            const addBtn = document.getElementById('add-seccion');

            addBtn.addEventListener('click', () => {
                const div = document.createElement('div');
                div.classList.add('input-group', 'mb-2');
                div.innerHTML = `
                    <input type="text" name="secciones[]" class="form-control" placeholder="Ej: 2" required>
                    <button type="button" class="btn btn-danger remove-seccion">Eliminar</button>
                `;
                wrapper.appendChild(div);
            });

            wrapper.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-seccion')) {
                    e.target.parentElement.remove();
                }
            });
        });
    </script>
</x-admin>
