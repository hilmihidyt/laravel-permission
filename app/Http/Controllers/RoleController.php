<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        return view('roles.index',[
            'roles' => Role::paginate(10)->withQueryString()
        ]);
    }

    public function edit(Role $role)
    {
        return view('roles.form',[
            'role'        => $role,
            'permissions' => Permission::get(),
        ]);
    }

    public function update(Request $request, Role $role)
    {
        $role->syncPermissions($request->permissions);

        return to_route('roles.index')->with('success', 'Role updated successfully');
    }
}
