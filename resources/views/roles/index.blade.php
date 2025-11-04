@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $title }}</h1>
            <div class="text-end mb-3">
                <a class="btn btn-primary btn-sm " href="{{ route('role.create') }}">Add Role</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($role as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->name }}</td>
                            <td class="w-25">
                                <a class="btn btn-primary btn-sm" href="{{ route('role.edit', $s->id) }}">Edit</a>
                                <form action="{{ route('role.destroy', $s->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('yakin ingin menghapus')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="3" >Data is still empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
