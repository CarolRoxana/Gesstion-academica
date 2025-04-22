<x-admin>
    @section('title', 'Editar Propuesta TG')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.propuesta_tg.update', $propuesta->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $propuesta->nombre) }}" required>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="descripcion" class="form-control">{{ old('descripcion', $propuesta->descripcion) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Fecha de Entrega</label>
                    <input type="date" name="fecha_entrega" class="form-control" value="{{ old('fecha_entrega', $propuesta->fecha_entrega) }}" required>
                </div>
                <div class="form-group">
                    <label>Propuesta (Archivo PDF)</label>
                    <input type="file" name="propuesta" class="form-control" accept="application/pdf">
                    @if($propuesta->propuesta)
                        <a href="{{ asset('storage/' . $propuesta->propuesta) }}" target="_blank" class="btn btn-info mt-2">Ver PDF Actual</a>
                    @endif
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
</x-admin>
