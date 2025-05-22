<x-admin>
    @section('title', 'Usuarios')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tabla de Usuarios</h3>
            <div class="card-tools"><a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary">Crear</a>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped" id="userTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Fecha de creación</th>
                        <th>Rol</th> <!-- Nueva columna -->
                        <th>Acción</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at }}</td>
                            <td>
                                <form action="{{ route('admin.user.updateRole', $user->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="role" onchange="this.form.submit()"
                                        class="form-control form-control-sm">
                                        <option value="">Sin rol</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}"
                                                {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                            <td>
                                <a href="{{ route('admin.user.edit', encrypt($user->id)) }}"
                                    class="btn btn-sm btn-primary">Editar</a>
                            </td>
                            <td>
                                <form action="{{ route('admin.user.destroy', encrypt($user->id)) }}" method="POST"
                                    onsubmit="return confirm('Are sure want to delete?')">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @section('js')
        <script>
            $(function() {
                $('#userTable').DataTable({
                    "paging": true,
                    "searching": true,
                    "ordering": true,
                    "responsive": true,
                });
            });
        </script>
    @endsection
</x-admin>
