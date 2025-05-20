<x-admin>
    @section('title', 'Editar Periodo Académico')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.periodo-academico.update', $periodo_academico->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Periodo</label>
                    <input type="text" name="periodo" class="form-control" value="{{ $periodo_academico->periodo }}"
                        required>
                </div>

                <div class="form-group">
                    <label>Fecha de Inicio</label>
                  <input type="date" name="fecha_inicio" class="form-control"
    value="{{ \Carbon\Carbon::parse($periodo_academico->fecha_inicio)->format('Y-m-d') }}" required>

                </div>

                <div class="form-group">
                    <label>Fecha de Finalización</label>
                   <input type="date" name="fecha_finalizacion" class="form-control"
    value="{{ \Carbon\Carbon::parse($periodo_academico->fecha_finalizacion)->format('Y-m-d') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('admin.periodo-academico.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize any JavaScript components here if needed

        });
    </script>
</x-admin>
