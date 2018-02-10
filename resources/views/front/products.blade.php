@extends('layouts.master') 
@section('title', 'Products Gallery') 
@section('content')
<!-- products listing -->
<!-- Latest Products -->
<div class="row">
    @forelse ($products->chunk(4) as $chunk) @foreach ($chunk as $product)
    <div class="small-3 columns">
        <div class="item-wrapper">
            <div class="img-wrapper">
                <a href="{{ route('cart.show', $product->id) }}" class="button expanded add-to-cart">Add to Cart</a>
                <a href="{{ route('product', $product->id) }}"><img src="{{ url('images', $product->image) }}"/></a>
            </div>
            <a href="{{ route('product', $product->id) }}">
                <h3>{{ $product->name }}</h3>
            </a>
            <h5>${{ $product->price }}</h5>
            <span>{{ $product->category->name }}</span>
            <p>{{ $product->description }}</p>
        </div>
    </div>
    @endforeach @empty
    <h3 class="alert alert-danger">There is no products</h3>
    @endforelse
</div>
@endsection