<x-admin>
    @section('title', 'Crear Talento Humano')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.talento_humano.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" name="apellido" class="form-control" value="{{ old('apellido') }}" required>
                </div>
                <div class="form-group">
                    <label>Cédula</label>
                    <input type="text" name="cedula" class="form-control" value="{{ old('cedula') }}" required>
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="correo" class="form-control" value="{{ old('correo') }}" required>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
                </div>
                <div class="form-group">
                    <label>Fecha de Postulación</label>
                    <input type="date" name="fecha_postulacion" class="form-control" value="{{ old('fecha_postulacion') }}" required>
                </div>
                <div class="form-group">
                    <label>Motivo</label>
                    <textarea name="motivo" class="form-control">{{ old('motivo') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Carrera Postulación</label>
                    <input type="text" name="carrera_postulacion" class="form-control" value="{{ old('carrera_postulacion') }}" required>
                </div>
                <div class="form-group">
                    <label>Unidad Curricular Postulación</label>
                    <input type="text" name="unidad_curricular_postulacion" class="form-control" value="{{ old('unidad_curricular_postulacion') }}" required>
                </div>
                <div class="form-group">
                    <label>Estatus</label>
                    <input type="text" name="estatus" class="form-control" value="{{ old('estatus') }}" required>
                </div>
                <div class="form-group">
                    <label>Observaciones</label>
                    <textarea name="observaciones" class="form-control">{{ old('observaciones') }}</textarea>
                </div>
                <div class="form-group">
                    <label>Fecha de Aprobación</label>
                    <input type="date" name="fecha_aprobacion" class="form-control" value="{{ old('fecha_aprobacion') }}">
                </div>
                <div class="form-group">
                    <label>Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso') }}" required>
                </div>
                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
</x-admin>
