@extends('layouts.app')

@section('content')
    {{-- @dd($users) --}}
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">Data Users</h1>
            <div class="text-end mb-3">
                <a class="btn btn-primary btn-sm " href="{{ route('user.create') }}">Add User</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                <tbody>
                    @forelse ($users as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->name }}</td>
                            <td>{{ $s->email }}</td>
                            <td>
                                <a class="btn btn-primary btn-sm" href="{{ route('user.edit',$s->id) }}">Edit</a>
                                <form action="{{ route('user.destroy', $s->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('yakin ingin menghapus')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr col="5">
                            <td>Data is still empty</td>
                        </tr>
                    @endforelse
                </tbody>
                </thead>
            </table>
        </div>
    </div>
@endsection
