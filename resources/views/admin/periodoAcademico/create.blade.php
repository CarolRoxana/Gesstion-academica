<x-admin>
    @section('title', 'Crear Periodo Académico')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.periodo-academico.create') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre del periodo académico</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ej: 2025 - I"  required>
                </div>
            
                <div class="form-group">
                    <label for="fecha_inicio">Fecha de inicio</label>
                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                </div>
            
                <div class="form-group">
                    <label for="fecha_fin">Fecha de fin</label>
                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                </div>
            
                <button type="submit" class="btn btn-primary">Crear Periodo Académico</button>
            </form>
        </div>
    </div>
</x-admin>
