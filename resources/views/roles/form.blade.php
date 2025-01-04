@extends('layouts.app')
@section('title',"{$role->name}")
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h1 class="fs-5">{{ $role->name }}</h1>
                </div>
                <div class="card-body">
                    <form action="{{ route('roles.update',$role->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="row mb-2">
                            @foreach ($permissions as $permission)
                            <div class="col-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{ $permission->name }}" id="permission{{ $permission->id }}" name="permissions[]" {{ in_array($permission->id, $role->permissions->pluck('id')->toArray()) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $permission->id }}">
                                        {{ $permission->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection