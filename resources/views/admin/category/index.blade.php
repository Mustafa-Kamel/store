@extends('admin.layouts.master')

@section('content')
    <h2>Product Categories</h2><br>

    @if (!empty($categories))
    
        @forelse ($categories as $category)
            <a class="btn btn-info" href="{{ route('category.show', $category->name) }}" role="button">{{ $category->name }}</a>
        @empty
            <h3 class="alert alert-danger">There's no categories</h3>
        @endforelse

    @elseif(!empty($category))
        <a class="btn btn-info" href="{{ route('category.show', $category->name) }}" role="button">{{ $category->name }}</a>
        @if (count($products))
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td scope="row">{{ $product->name }}</td>
                            <td>{{ $product->size }}</td>
                            <td>${{ $product->price }}</td>
                            <td><img src="{{ url('images', $product->image) }}" alt="{{ $product->name }}" width="80"></td>
                            <td>{{ $product->description }}</td>
                        <td>
                            <form action="{{ route('products.destroy', $product->id) }}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h4 class="alert alert-danger">There's no products</h4>
        @endif
    @endif

    <br><br>
    @include('layouts.errors')
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
      Add Category
    </button>
    
    
    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="modelTitleId">Add Category</h4>
                </div>
                <form action="{{ route('category.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection