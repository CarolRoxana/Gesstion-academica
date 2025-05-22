<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    public function index()
    {
        $data = Role::orderBy('id', 'DESC')->get();
        return view('admin.role.index', compact('data'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);
        Role::updateOrCreate(
            [
                'id' => $request->id
            ],
            [
                'name' => $request->name,
            ]
        );
        if ($request->id) {
            $msg = 'Role updated successfully.';
        } else {
            $msg = 'Role created successfully.';
        }
        return redirect()->route('admin.role.index')->with('success', $msg);
    }

    public function edit($id)
    {
        $data = Role::where('id', decrypt($id))->first();
        $permissions = Permission::all();
        $rolePermissions = $data->permissions->pluck('name')->toArray();

        // Asegúrate que el modelo User use el trait HasRoles de Spatie
        // Esto permite usar getAllPermissions()
        $userPermissions = [];
        if (Auth::check() && method_exists(Auth::user(), 'getAllPermissions')) {
            $userPermissions = Auth::user()->getAllPermissions()->pluck('name')->toArray();
        }

        return view('admin.role.edit', compact('data', 'permissions', 'rolePermissions', 'userPermissions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
            'permissions' => 'array'
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->save();

        // Asignar permisos seleccionados
        $role->syncPermissions($request->permissions ?? []);

        return redirect()->route('admin.role.index')->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy($id)
    {


      try {
            $role = Role::findOrFail($id);
            $role->delete();
            return redirect()->route('admin.role.index')->with('success', 'Rol eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.role.index')->with('error', 'Error al eliminar el rol: ' . $e->getMessage());
        }
    
    
    }
}
