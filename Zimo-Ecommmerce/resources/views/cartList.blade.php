@extends('layouts.default')

@section('title','Cart List')


@section('content')

<div class="container mt-5">
    <h1 class="mb-4">Cart List</h1>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Product Name</th>
            <th>Unit Price</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Action</th>

        </tr>
        </thead>
        <tbody>
        @foreach ($cartItem as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>${{ $item->product->Price }}</td>
                <td>{{ $item->product->description }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ $item->total_price }}</td>
                <td>
                    <div class="d-flex">
                        <form action="{{ route('increment', $item->id) }}" method="POST" class="me-1">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-success">+</button>
                        </form>
                        <form action="{{ route('decrement', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-danger">-</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <a href="{{ url('/') }}" class="btn btn-dark">Continue Shopping</a>
</div>


@endsection




