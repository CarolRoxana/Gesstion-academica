<x-admin>
    @section('title', 'Crear Propuesta TG')
    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('admin.propuesta_tg.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Nombre del Tesista</label>
                    <input type="text" name="nombre_tesista" class="form-control" value="{{ old('nombre_tesista') }}" required>
                </div>

                <div class="form-group">
                    <label>Apellido del Tesista</label>
                    <input type="text" name="apellido_tesista" class="form-control" value="{{ old('apellido_tesista') }}" required>
                </div>

                <div class="form-group">
                    <label>Cédula</label>
                    <input type="text" name="cedula" class="form-control" value="{{ old('cedula') }}" required>
                </div>

                <div class="form-group">
                    <label>Carrera</label>
                    <select name="carrera" class="form-control" required>
                        <option value="">Seleccione una carrera</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera }}">{{ $carrera }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Título de la Propuesta</label>
                    <input type="text" name="titulo_propuesta" class="form-control" value="{{ old('titulo_propuesta') }}" required>
                </div>

                <div class="form-group">
                    <label>Docente Asignado</label>
                    <select name="docente_id" class="form-control" required>
                        <option value="">Seleccione un docente</option>
                        @foreach($docentes as $docente)
                            <option value="{{ $docente->id }}">{{ $docente->nombre }} {{ $docente->apellido }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Estatus</label>
                    <select name="estatus" class="form-control" required>
                        <option value="pendiente">Pendiente</option>
                        <option value="aprobada">Aprobada</option>
                        <option value="rechazada">Rechazada</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Fecha de Ingreso</label>
                    <input type="date" name="fecha_ingreso" class="form-control" value="{{ old('fecha_ingreso') ?? now()->toDateString() }}" required>
                </div>

                <div class="form-group">
                    <label>Archivo de Propuesta (PDF)</label>
                    <input type="file" name="propuesta" class="form-control" accept="application/pdf" required>
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
            </form>

        </div>
    </div>
</x-admin>
