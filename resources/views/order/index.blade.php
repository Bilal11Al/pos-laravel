@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h1 class="card-title">{{ $title }}</h1>
            <div class="text-end mb-3">
                <a class="btn btn-primary btn-sm " href="{{ route('order.create') }}">Add Order</a>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order number</th>
                        <th>Amount</th>
                        <th>Change</th>
                        <th>Subtotal</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($order as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $s->order_code }}</td>
                            <td>{{ $s->order_amount }}</td>
                            <td>{{ $s->order_change }}</td>
                            <td>{{ $s->order_status}}</td>
                            <td>{{ $s->order_subtotal }}</td>
                            <td>{{ $s->created_at }}</td>
                            <td class="w-25">
                                <a class="btn btn-primary btn-sm" href="{{ route('order.edit', $s->id) }}">Edit</a>
                                <form action="{{ route('order.destroy', $s->id) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('yakin ingin menghapus')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="10">Data is still empty</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
