@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ isset($users) ? 'Update Users' : 'Create users' }}</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p>{{ $error }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            <form action="{{ isset($users) ? route('user.update', $users->id) : route('user.store') }}" method="POST">
                @csrf
                @if (isset($users))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', isset($users) ? $users->name : '') }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                        value="{{ old('email', isset($users) ? $users->email : '') }}">
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    {{ isset($users) ? 'update' : 'create' }}
                </button>
                <a class="btn btn-danger btn-sm" href="{{ route('user.index') }}">Back</a>
            </form>
        </div>
    </div>
@endsection
