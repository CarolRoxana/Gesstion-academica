<x-admin>
    @section('title', 'Editar Docente')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.docente_unit.update', $docente->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- ---------- datos básicos ---------- --}}
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control"
                           value="{{ old('nombre', $docente->nombre) }}" required>
                </div>

                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" name="apellido" class="form-control"
                           value="{{ old('apellido', $docente->apellido) }}" required>
                </div>

                <div class="form-group">
                    <label>Cédula</label>
                    <input type="text" name="cedula" class="form-control"
                           value="{{ old('cedula', $docente->cedula) }}" required>
                </div>

                <div class="form-group">
                    <label>Título Profesional</label>
                    <input type="text" name="titulo" class="form-control"
                           value="{{ old('titulo', $docente->titulo) }}" required>
                </div>

                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="correo" class="form-control"
                           value="{{ old('correo', $docente->correo) }}">
                </div>

                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control"
                           value="{{ old('telefono', $docente->telefono) }}">
                </div>

                {{-- ---------- nuevos campos ---------- --}}
                <hr>

                <div class="form-group">
                    <label>Maestría</label>
                    <input type="text" name="maestria" class="form-control"
                           value="{{ old('maestria', $docente->maestria) }}"
                           placeholder="Ej.: MSc en Educación">
                </div>

                <div class="form-group">
                    <label>Doctorado</label>
                    <input type="text" name="doctorado" class="form-control"
                           value="{{ old('doctorado', $docente->doctorado) }}"
                           placeholder="Ej.: PhD en Ciencias">
                </div>

                <div class="form-group">
                    <label>Postgrado</label>
                    <input type="text" name="postgrado" class="form-control"
                           value="{{ old('postgrado', $docente->postgrado) }}"
                           placeholder="Especialización, diplomado…">
                </div>

                <div class="form-group">
                    <label>Otro (estudios / certificaciones)</label>
                    <input type="text" name="otro" class="form-control"
                           value="{{ old('otro', $docente->otro) }}"
                           placeholder="Otra formación relevante">
                </div>

                <div class="form-group">
                    <label>Categoría</label>
                    <select name="categoria" class="form-control">
                        <option value="" {{ old('categoria', $docente->categoria) == '' ? 'selected' : '' }}>
                            Sin asignar
                        </option>
                        <option value="Categoría 1"
                            {{ old('categoria', $docente->categoria) == 'Categoría 1' ? 'selected' : '' }}>
                            Categoría&nbsp;1
                        </option>
                        <option value="Categoría 2"
                            {{ old('categoria', $docente->categoria) == 'Categoría 2' ? 'selected' : '' }}>
                            Categoría&nbsp;2
                        </option>
                        <option value="Categoría 3"
                            {{ old('categoria', $docente->categoria) == 'Categoría 3' ? 'selected' : '' }}>
                            Categoría&nbsp;3
                        </option>
                        <option value="Categoría 4"
                            {{ old('categoria', $docente->categoria) == 'Categoría 4' ? 'selected' : '' }}>
                            Categoría&nbsp;4
                        </option>
                        <option value="Categoría 5"
                            {{ old('categoria', $docente->categoria) == 'Categoría 5' ? 'selected' : '' }}>
                            Categoría&nbsp;5
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tipo de Contratación</label>
                    <select name="tipo_contratacion" class="form-control">
                        <option value="" {{ old('tipo_contratacion', $docente->tipo_contratacion) == '' ? 'selected' : '' }}>
                            Sin asignar
                        </option>
                        <option value="Fijo"
                            {{ old('tipo_contratacion', $docente->tipo_contratacion) == 'Fijo' ? 'selected' : '' }}>
                            Fijo
                        </option>
                        <option value="Honorario profesionales"
                            {{ old('tipo_contratacion', $docente->tipo_contratacion) == 'Honorario profesionales' ? 'selected' : '' }}>
                            Honorario profesionales
                        </option>
                        <option value="Contratación especial"
                            {{ old('tipo_contratacion', $docente->tipo_contratacion) == 'Contratación especial' ? 'selected' : '' }}>
                            Contratación especial
                        </option>
                    </select>
                </div>
                <a href="{{ route('admin.docente_unit.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-1"></i> Volver
                </a>
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</x-admin>
