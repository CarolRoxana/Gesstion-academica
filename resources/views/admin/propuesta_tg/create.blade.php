<x-admin>
    @section('title', 'Crear Propuesta TG')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.propuesta_tg.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Fecha de Entrega</label>
                    <input type="date" name="fecha_entrega" class="form-control" value="{{ old('fecha_entrega') }}" required>
                </div>
                <div class="form-group">
                    <label>Propuesta (Archivo PDF)</label>
                    <input type="file" name="propuesta" class="form-control" accept="application/pdf" required>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
</x-admin>
