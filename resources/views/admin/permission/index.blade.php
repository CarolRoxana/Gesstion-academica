<x-admin>
    @section('title', 'Permisos')

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Permisos</h3>
            <div class="card-tools">
                <a href="{{ route('admin.permission.create') }}" class="btn btn-sm btn-primary">Agregar permiso</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="collectionTable">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Modulo</th> <!-- Nueva columna para mostrar el módulo -->
                        <th>Fecha de creación</th>
                        <th>Acción</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ ucfirst(str_replace('_', ' ', $permission->name)) }}</td> <!-- Mostrar el módulo asociado -->
                            <td>{{ $permission->created_at }}</td>
                            <td>
                                <a href="{{ route('admin.permission.edit', encrypt($permission->id)) }}"
                                    class="btn btn-sm btn-secondary">
                                    <i class="far fa-edit"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('admin.permission.destroy', encrypt($permission->id)) }}"
                                    method="POST" onclick="return confirm('Are you sure?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center bg-danger">No permissions created</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @section('js')
        <script>
            $(function() {
                $('#collectionTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
