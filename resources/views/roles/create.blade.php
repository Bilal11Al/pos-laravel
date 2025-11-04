@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ isset($role) ? 'Update Role' : 'Create Role' }}</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p>{{ $error }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            <form action="{{ isset($role) ? route('role.update', $role->id) : route('role.store') }}"
                method="POST">
                @csrf
                @if (isset($role))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', isset($role) ? $role->name : '') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    {{ isset($role) ? 'save Change' : 'Save' }}
                </button>
                <a class="btn btn-danger btn-sm" href="{{ route('role.index') }}">Back</a>
            </form>
        </div>
    </div>
@endsection
