@extends('admin.layouts.master')

@section('content')
<h2>Product Details</h2>
    <div class="text-left">
        @include('layouts.errors')
        <div class="col-8">
            <form action="{{action('ProductController@store')}}" method="post" enctype="multipart/form-data">
            {{--  <form action="{{url('admin/products')}}" method="post" enctype="multipart/form-data">  --}}
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}" required autofocus>
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" name="price" id="price" class="form-control" min="0.01" step="0.01" value="{{old('price')}}" required>
                </div>
                <div class="form-group">
                    <label for="size">Size</label>
                    <select name="size" id="size" class="form-control" required>
                        <option value="Large">Large</option>
                        <option value="Medium">Medium</option>
                        <option value="Small">Small</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" id="category" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{$category['id']}}" @if ($category->id == old('category_id')) selected @endif>{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" id="image" class="form-control-file">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="5" class="form-control" required>{{old('description')}}</textarea>
                </div>
                <button type="submit" class="btn btn-info btn-md btn-block">Add Product</button>
            </form>
        </div>
    </div>
@endsection