<x-admin>
    @section('title', 'Editar Rol y Permisos')
    <section class="content">
        <!-- Default box -->
        <div class="d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Editar Rol</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.role.index') }}" class="btn btn-sm btn-dark">Volver</a>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('admin.role.update', $data->id) }}" method="POST" class="needs-validation"
                        novalidate="">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $data->id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="name" class="form-label">Nombre Rol</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            required="" value="{{ $data->name }}">
                                        <x-error>name</x-error>
                                        <div class="invalid-feedback">El campo de nombre del rol es obligatorio.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label">Permisos del Rol</label>
                                        <div class="row">
                                            @foreach ($permissions as $permission)
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="permissions[]" value="{{ $permission->name }}"
                                                            id="perm_{{ $permission->id }}"
                                                            {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                                        <label class="form-check-label"
                                                            for="perm_{{ $permission->id }}">
                                                            {{ $permission->name }}
                                                            @if (in_array($permission->name, $userPermissions))
                                                                <span class="badge bg-success">Tú</span>
                                                            @endif
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer float-end float-right">
                            <button type="submit" id="submit"
                                class="btn btn-primary float-end float-right">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </section>
</x-admin>
