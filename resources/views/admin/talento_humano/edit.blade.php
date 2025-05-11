<x-admin>
    @section('title', 'Editar Talento Humano')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.talento_humano.update', $talentoHumano->id) }}" method="POST">
                @csrf
                @method('PUT')
                <!-- Aquí van los mismos campos de la vista create, pero con valores prellenados -->
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $talentoHumano->nombre) }}" required>
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" name="apellido" class="form-control" value="{{ old('apellido', $talentoHumano->apellido) }}" required>
                </div>
                <div class="form-group">
                    <label>Cédula</label>
                    <input type="text" name="cedula" class="form-control" value="{{ old('cedula', $talentoHumano->cedula) }}" required>
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="correo" class="form-control" value="{{ old('correo', $talentoHumano->correo) }}" required>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $talentoHumano->telefono) }}">
                </div>
                <div class="form-group">
                    <label>Fecha de Postulación</label>
                    <input type="date" name="fecha_postulacion" class="form-control" value="{{ old('fecha_postulacion', $talentoHumano->fecha_postulacion) }}" required>
                </div>
                <div class="form-group">
                    <label>Motivo</label>
                    <textarea name="motivo" class="form-control">{{ old('motivo') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Carrera Postulación</label>
                    <input type="text" name="carrera_postulacion" class="form-control" value="{{ old('carrera_postulacion', $talentoHumano->carrera_postulada) }}" required>
                </div>
                <div class="form-group">
                    <label>Unidad Curricular Postulación</label>
                    <input type="text" name="unidad_curricular_postulacion" class="form-control" value="{{ old('unidad_curricular_postulacion', $talentoHumano->unidad_curricular_postulacion) }}" required>
                </div>
                <div class="form-group">
                    <label>Estatus</label>
                    <input type="text" name="estatus" class="form-control" value="{{ old('estatus', $talentoHumano->estatus) }}" required>
                </div>
                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Fecha de Aprobación</label>
                    <input type="date" name="fecha_aprobacion" class="form-control" value="{{ old('fecha_aprobacion', $talentoHumano->fecha_aprobacion) }}">
                </div>
                <div class="form-group">
                    <label>Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso', $talentoHumano->fecha_ingreso) }}" required>
                </div>
                <button type="submit" class="btn btn-success">Actualizar</button>
            </form>
        </div>
    </div>
</x-admin>
