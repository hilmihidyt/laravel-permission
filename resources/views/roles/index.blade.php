@extends('layouts.app')
@section('title', 'Roles')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h1 class="fs-5">Roles</h1>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Permissions</th>
                                <th scope="col" class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $key => $role)
                            <tr>
                                <th scope="row">{{ ++$key }}</th>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @forelse($role->permissions as $permission)
                                    <span class="badge bg-dark me-1">{{ $permission->name }}</span>
                                    @empty
                                    -
                                    @endforelse
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">No roles found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection