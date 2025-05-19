<x-admin>
    @section('title', 'Propuestas de Trabajo de grado')

    <div class="card">
        <div class="card-body">
            <a href="{{ route('admin.propuesta_tg.create') }}" class="btn btn-primary mb-3">Crear Propuesta</a>
            <a href="{{ route('admin.admin.propuestas.grado.pdf') }}" class="btn btn-danger mb-3">
                <i class="fas fa-file-pdf"></i> Exportar Trabajos de Grado
            </a>
            
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre(s) Tesista(s)</th>
                        <th>Título de Propuesta</th>
                        <th>Docente Tutor</th>
                        <th>Estatus</th>
                        <th>Fecha Ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($propuestas as $propuesta)
                        <tr>
                            <td>
                                {{ $propuesta->nombre_tesista }} {{ $propuesta->apellido_tesista }}
                                
                                @if(isset($propuesta->nombre_tesista2) && !empty($propuesta->nombre_tesista2))
                                    <br>{{ $propuesta->nombre_tesista2 }} {{ $propuesta->apellido_tesista2 }}
                                @endif
                                
                                @if(isset($propuesta->nombre_tesista3) && !empty($propuesta->nombre_tesista3))
                                    <br>{{ $propuesta->nombre_tesista3 }} {{ $propuesta->apellido_tesista3 }}
                                @endif
                            </td>
                            <td>{{ $propuesta->titulo_propuesta }}</td>
                            <td>{{ $propuesta->docente->nombre }} {{ $propuesta->docente->apellido }}</td>
                            <td>{{ $propuesta->estatus }}</td>
                            <td>{{ \Carbon\Carbon::parse($propuesta->fecha_ingreso)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('admin.propuesta_tg.show', $propuesta->id) }}" class="btn btn-sm btn-success">Ver </a>
                                <a href="{{ route('admin.propuesta_tg.edit', $propuesta->id) }}"  class="btn btn-sm btn-primary">Editar</a>
                                <form action="{{ route('admin.propuesta_tg.destroy', $propuesta->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin>