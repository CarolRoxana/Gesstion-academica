<x-admin>
    @section('title', 'Crear Docente')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.docente_unit.store') }}" method="POST">
                @csrf

                {{-- ---------- datos básicos ---------- --}}
                <div class="form-group">
                    <label>Nombre</label>
                    <input type="text" name="nombre" class="form-control"
                           value="{{ old('nombre') }}" required>
                </div>

                <div class="form-group">
                    <label>Apellido</label>
                    <input type="text" name="apellido" class="form-control"
                           value="{{ old('apellido') }}" required>
                </div>

                <div class="form-group">
                    <label>Cédula</label>
                    <input type="text" name="cedula" class="form-control"
                           value="{{ old('cedula') }}" required>
                </div>

                <div class="form-group">
                    <label>Título Profesional</label>
                    <input type="text" name="titulo" class="form-control"
                           value="{{ old('titulo') }}" required>
                </div>

                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="correo" class="form-control"
                           value="{{ old('correo') }}">
                </div>

                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control"
                           value="{{ old('telefono') }}">
                </div>

                {{-- ---------- nuevos campos ---------- --}}
                <hr>

                <div class="form-group">
                    <label>Maestría</label>
                    <input type="text" name="maestria" class="form-control"
                           value="{{ old('maestria') }}"
                           placeholder="Ej.: MSc en Educación">
                </div>

                <div class="form-group">
                    <label>Doctorado</label>
                    <input type="text" name="doctorado" class="form-control"
                           value="{{ old('doctorado') }}"
                           placeholder="Ej.: PhD en Ciencias">
                </div>

                <div class="form-group">
                    <label>Postgrado</label>
                    <input type="text" name="postgrado" class="form-control"
                           value="{{ old('postgrado') }}"
                           placeholder="Especialización, diplomado…">
                </div>

                <div class="form-group">
                    <label>Otro (estudios / certificaciones)</label>
                    <input type="text" name="otro" class="form-control"
                           value="{{ old('otro') }}"
                           placeholder="Otra formación relevante">
                </div>

                <div class="form-group">
                    <label>Categoría</label>
                    <select name="categoria" class="form-control">
                        <option value="" {{ old('categoria') == '' ? 'selected' : '' }}>
                            Sin asignar
                        </option>
                        <option value="Categoría 1" {{ old('categoria') == 'Categoría 1' ? 'selected' : '' }}>
                            Categoría&nbsp;1
                        </option>
                        <option value="Categoría 2" {{ old('categoria') == 'Categoría 2' ? 'selected' : '' }}>
                            Categoría&nbsp;2
                        </option>
                        <option value="Categoría 3" {{ old('categoria') == 'Categoría 3' ? 'selected' : '' }}>
                            Categoría&nbsp;3
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Tipo de Contratación</label>
                    <select name="tipo_contratacion" class="form-control">
                        <option value="" {{ old('tipo_contratacion') == '' ? 'selected' : '' }}>
                            Sin asignar
                        </option>
                        <option value="Fijo" {{ old('tipo_contratacion') == 'Fijo' ? 'selected' : '' }}>
                            Fijo
                        </option>
                        <option value="Honorario profesionales"
                            {{ old('tipo_contratacion') == 'Honorario profesionales' ? 'selected' : '' }}>
                            Honorario profesionales
                        </option>
                        <option value="Contratación especial"
                            {{ old('tipo_contratacion') == 'Contratación especial' ? 'selected' : '' }}>
                            Contratación especial
                        </option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
</x-admin>
