@extends('admin.layouts.master') 
@section('content')
<h2>Products</h2>
<table class="table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Size</th>
            <th>Price</th>
            <th>Category</th>
            <th>Image</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
        <tr>
            <td scope="row">{{ $product->name }}</td>
            <td>{{ $product->size }}</td>
            <td>${{ $product->price }}</td>
            <td>{{ $product->category->name }}</td>
            <td><img src="{{ url('images', $product->image) }}" alt="{{ $product->name }}" width="80"></td>
            <td>{{ $product->description }}</td>
            <td>
                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            {{-- <a href="#" class="btn btn-success">Add to Cart</a> --}}
        </tr>
        @empty
        <h3 class="alert alert-danger">There's no products</h3>
        @endforelse
    </tbody>
</table>
@endsection