<x-admin>
    @section('title','Servicios Comunitarios')

    @section('content_header')
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Listado de Servicios Comunitarios</h1>
            <a class="btn btn-primary" href="{{ route('admin.servicio_comunitario.create') }}">
                <i class="fas fa-plus me-1"></i> Nuevo servicio
            </a>
        </div>
    @endsection

    <div class="card shadow-sm border-0">
        <div class="card-body table-responsive p-0">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Estudiante</th>
                        <th>Carrera</th>
                        <th>Título</th>
                        <th>Docente</th>
                        <th>Estado</th>
                        <th>Ingreso</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($servicios as $s)
                    @php
                        $badge = ['aprobado'=>'success','rechazado'=>'danger','pendiente'=>'warning','proceso'=>'info'][$s->estatus] ?? 'secondary';
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $s->nombre_estudiante }} {{ $s->apellido_estudiante }}</td>
                        <td>{{ $s->carrera }}</td>
                        <td>{{ Str::limit($s->titulo_servicio,40) }}</td>
                        <td>{{ $s->docente->nombre }} {{ $s->docente->apellido }}</td>
                        <td><span class="badge bg-{{ $badge }}">{{ $s->estatus }}</span></td>
                        <td>{{ \Carbon\Carbon::parse($s->fecha_ingreso)->format('d/m/Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.servicio_comunitario.show',$s) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.servicio_comunitario.edit',$s) }}" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.servicio_comunitario.destroy',$s) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('¿Eliminar definitivamente?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $servicios->links() }}
        </div>
    </div>
</x-admin>
