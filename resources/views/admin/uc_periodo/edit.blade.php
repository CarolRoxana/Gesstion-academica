<x-admin>
    @section('title', 'Editar Asignación')

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.unidad-curricular-periodo.update', $registro->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Unidad Curricular</label>
                    <select name="unidad_curricular_id" class="form-control" required>
                        @foreach ($unidad_curricular as $uc)
                            <option value="{{ $uc->id }}"
                                {{ $registro->unidad_curricular_id == $uc->id ? 'selected' : '' }}>
                                {{ $uc->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Periodo Académico</label>
                    <select name="periodo_academico_id" class="form-control" required>
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}"
                                {{ $registro->periodo_academico_id == $periodo->id ? 'selected' : '' }}>
                                {{ $periodo->periodo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Sede</label>

                    <select name="sede" class="form-control" required>
                        @foreach ($sedes as $sede)
                            <option value="{{ $sede }}" {{ $registro->sede == $sede ? 'selected' : '' }}>
                                {{ $sede }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Modalidad</label>
                    <select name="modalidad" class="form-control" required>
                        <option value="">Seleccione</option>
                        <option value="Presencial" {{ $registro->modalidad == 'Presencial' ? 'selected' : '' }}>
                            Presencial</option>
                        <option value="Virtual" {{ $registro->modalidad == 'Virtual' ? 'selected' : '' }}>Virtual
                        </option>
                    </select>
                </div>

                <div class="form-group">

                    <label>Módulos</label>
                    <select name="modulo" class="form-control">
                        @foreach ($modulos as $modulo)
                            <option value="{{ $modulo }}" {{ $registro->modulo == $modulo ? 'selected' : '' }}>
                                {{ $modulo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                 <div class="form-group">
                    <label>Pisos</label>
                    <select name="piso" class="form-control">
                        @foreach ($pisos as $piso)
                            <option value="{{ $piso }}" {{ $registro->piso == $piso ? 'selected' : '' }}>
                                {{ $piso }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
            </form>
        </div>
    </div>
</x-admin>
