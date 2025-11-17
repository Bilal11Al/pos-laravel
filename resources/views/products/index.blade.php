@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $title }}</h1>
            <div class="text-end mb-3">
                <a class="btn btn-primary btn-sm " href="{{ route('product.create') }}">Add Product</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Photo</th>
                        <th>price</th>
                        <th>Active</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($product as $key => $s)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $s->product_name }}</td>
                            <td>{{ $s->category->name ?? '' }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $s->product_photo) }}" alt="" width="100px">
                            </td>
                            <td>{{ $s->product_price }}</td>
                            <td>
                                <span class="{{ $s->is_active_class }}">{{ $s->is_active_text }}</span>
                            </td>
                            <td class="w-25">
                                <a class="btn btn-primary btn-sm" href="{{ route('product.edit', $s->id) }}">Edit</a>
                                <form action="{{ route('product.destroy', $s->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('yakin ingin menghapus')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach ()

                </tbody>
            </table>
        </div>
    </div>
@endsection
