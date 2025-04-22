<x-admin>
    @section('title', 'Editar Periodo Académico')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.periodo_academico.update', $periodo_academico) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Periodo</label>
                    <input type="text" name="periodo" class="form-control" value="{{ $periodo_academico->periodo }}" required>
                </div>

                <div class="form-group">
                    <label>Fecha de Inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control" value="{{ $periodo_academico->fecha_inicio }}" required>
                </div>

                <div class="form-group">
                    <label>Fecha de Finalización</label>
                    <input type="date" name="fecha_finalizacion" class="form-control" value="{{ $periodo_academico->fecha_finalizacion }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('admin.periodo_academico.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</x-admin>
