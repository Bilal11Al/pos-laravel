@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $title }}</h1>
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <p>{{ $error }}</p>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endforeach
            @endif
            <form action="{{ route('product.update', $edit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="text" name="product_name" class="form-control"
                                value="{{ $edit->product_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Category</label>
                            <select class="form-control" name="category_id" id="">
                                <option value="">---Select Category-----</option>
                                @foreach ($categories as $s)
                                    <option {{ $edit->category_id == $s->id ? 'selected' : '' }}
                                        value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Status</label>
                            <br>
                            <input type="radio" id="is_active" name="is_active" value="1"
                                {{ $edit->is_active == '1' ? 'checked' : '' }}>Publish
                            <input type="radio" id="is_active" name="is_active" value="0"
                                {{ $edit->is_active == '0' ? 'checked' : '' }}>Draft
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="" class="form-label">Photo</label>
                            <input type="file" name="product_photo" class="form-control" value="">
                            <img class="mt-2" src="{{ asset('storage/' . $edit->product_photo) }}" alt="{{ $edit->product_photo }}"
                                width="100px">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Price</label>
                            <input type="number" name="product_price" class="form-control"
                                value="{{ $edit->product_price }}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Description</label>
                            <textarea name="product_description" class="form-control" cols="20" rows="5">{{ $edit->product_description }}</textarea>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-sm">Save Change</button>
                <a class="btn btn-danger btn-sm" href="{{ route('product.index') }}">Back</a>
            </form>
        </div>
    </div>
@endsection
