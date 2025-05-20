<x-admin>
    @section('title', 'Crear Unidad Curricular')

    <form action="{{ route('admin.unidad-curricular.index') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Unidad de crédito</label>
            <input type="number" name="unidad_curricular" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="carrera">Carrera</label>
            <select name="carrera" class="form-control" required>
                <option value="">Seleccione una carrera</option>
                @foreach ($carreras as $carrera)
                    <option value="{{ $carrera->id }}">{{ $carrera->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Semestre</label>
            <select name="semestre" class="form-control" required>
                <option value="">Seleccione un semestre</option>
                @for ($i = 1; $i <= 9; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
        </div>

        <hr>

        <div class="form-group">
            <label>Secciones</label>
            <div id="secciones-container">
                <div class="d-flex mb-2">
                    <input type="text" name="secciones[]" class="form-control" placeholder="Ej: 1" required>
                    <button type="button" class="btn btn-danger ml-2 remove-seccion">&times;</button>
                </div>
            </div>
            <button type="button" class="btn btn-secondary mt-2" id="add-seccion">Agregar Sección</button>
        </div>

        <button class="btn btn-primary mt-3">Guardar</button>
    </form>

  
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('add-seccion').addEventListener('click', function() {
                    const container = document.getElementById('secciones-container');
                    const div = document.createElement('div');
                    div.className = 'd-flex mb-2';
                    div.innerHTML = `
            <input type="text" name="secciones[]" class="form-control" placeholder="Ej: 2" required>
            <button type="button" class="btn btn-danger ml-2 remove-seccion">&times;</button>
        `;
                    container.appendChild(div);
                });

                document.addEventListener('click', function(e) {
                    if (e.target && e.target.classList.contains('remove-seccion')) {
                        e.target.parentElement.remove();
                    }
                });
            });
        </script>
    
</x-admin>
