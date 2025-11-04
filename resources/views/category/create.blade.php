@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ isset($category) ? 'Update Category' : 'Create Category' }}</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p>{{ $error }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            <form action="{{ isset($category) ? route('category.update', $category->id) : route('category.store') }}"
                method="POST">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
                <div class="mb-3">
                    <label for="" class="form-label">Category Name</label>
                    <input type="text" name="name" class="form-control"
                        value="{{ old('name', isset($category) ? $category->name : '') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-sm">
                    {{ isset($category) ? 'save Change' : 'Save' }}
                </button>
                <a class="btn btn-danger btn-sm" href="{{ route('category.index') }}">Back</a>
            </form>
        </div>
    </div>
@endsection
