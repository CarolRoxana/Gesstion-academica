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

                <h5 class="fw-bold mb-3">Estudiantes que realizarán el trabajo</h5>

                <div id="estudiantes-container">
                    <div class="estudiante border p-3 rounded mb-3">
                        <div class="form-group mb-2">
                            <label>Nombre</label>
                            <input type="text" name="estudiantes[0][nombre]" class="form-control" required>
                        </div>

                        <div class="form-group mb-2">
                            <label>Apellido</label>
                            <input type="text" name="estudiantes[0][apellido]" class="form-control" required>
                        </div>

                        <div class="form-group mb-2">
                            <label>Cédula</label>
                            <input type="text" name="estudiantes[0][cedula]" class="form-control" required>
                        </div>

                        <div class="form-group mb-2">
                            <label>Carrera</label>
                            <select name="estudiantes[0][carrera]" class="form-control" required>
                                <option value="">Seleccione una carrera</option>
                                @foreach ($carreras as $carrera)
                                    <option value="{{ $carrera }}">{{ $carrera }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-outline-primary btn-sm mb-3" id="agregar-estudiante">
                    + Agregar otro estudiante
                </button>

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

                <button type="submit" class="btn btn-success mt-3">Guardar</button>
            </form>

        </div>
    </div>

    @push('scripts')
    <script>
        let estudianteIndex = 1;

        document.getElementById('agregar-estudiante').addEventListener('click', () => {
            const container = document.getElementById('estudiantes-container');

            const html = `
            <div class="estudiante border p-3 rounded mb-3">
                <div class="form-group mb-2">
                    <label>Nombre</label>
                    <input type="text" name="estudiantes[${estudianteIndex}][nombre]" class="form-control" required>
                </div>

                <div class="form-group mb-2">
                    <label>Apellido</label>
                    <input type="text" name="estudiantes[${estudianteIndex}][apellido]" class="form-control" required>
                </div>

                <div class="form-group mb-2">
                    <label>Cédula</label>
                    <input type="text" name="estudiantes[${estudianteIndex}][cedula]" class="form-control" required>
                </div>

                <div class="form-group mb-2">
                    <label>Carrera</label>
                    <select name="estudiantes[${estudianteIndex}][carrera]" class="form-control" required>
                        <option value="">Seleccione una carrera</option>
                        @foreach ($carreras as $carrera)
                            <option value="{{ $carrera }}">{{ $carrera }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            `;

            container.insertAdjacentHTML('beforeend', html);
            estudianteIndex++;
        });
    </script>
    @endpush
</x-admin>
