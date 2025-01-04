<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index',[
            'users' => User::paginate(10)->withQueryString()
        ]);
    }

    public function create()
    {
        return view('users.form',[
            'user'   => new User(),
            'submit' => 'Create',
            'action' => route('users.store'),
            'method' => 'POST',
            'title'  => 'Create User',
            'roles'  => Role::get()
        ]);
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt('password')
        ]);

        $user->assignRole($request->role);

        return to_route('users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('users.form',[
            'user'   => $user,
            'submit' => 'Update',
            'action' => route('users.update', $user),
            'method' => 'PUT',
            'title'  => 'Edit User',
            'roles'  => Role::get()
        ]);
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
        ]);

        $user->syncRoles($request->role);

        return to_route('users.index')->with('success', 'User updated successfully');
    }
}
