<x-admin>
    @section('title', 'Editar Docente')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.docente.update', $docente->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ $docente->nombre }}" required>
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" name="apellido" class="form-control" value="{{ $docente->apellido }}" required>
                </div>
                <div class="form-group">
                    <label>Cédula</label>
                    <input type="text" name="cedula" class="form-control" value="{{ $docente->cedula }}" required>
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="correo" class="form-control" value="{{ $docente->correo }}">
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ $docente->telefono }}">
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</x-admin>
