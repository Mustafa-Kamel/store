@extends('layouts.master') 
@section('title', $product->name) 
@section('content')
<!-- products listing -->
<!-- Latest SHirts -->
<div class="row">
    <div class="small-5 small-offset-1 columns">
        <div class="item-wrapper">
            <div class="img-wrapper">
                <a href="#">
                            <img src="{{ url('images', $product->image) }}"/>
                    </a>
            </div>
        </div>
    </div>
    <div class="small-6 columns">
        <div class="item-wrapper">
            <h3 class="subheader">
                <span class="price-tag">{{ $product->name }}</span> Store Designed Product
            </h3>
            <a href="{{ url('category', $product->Category->id) }}">
                <h3>{{ $product->Category->name }}</h3>
            </a>
            <h5>${{ $product->price }}</h5>
            <p>{{ $product->description }}</p>
            <div class="row">
                <div class="large-12 columns">
                    <label>
                            Select Size
                            <select>
                                <option value="small">
                                    Small
                                </option>
                                <option value="medium">
                                    Medium
                                </option>
                                <option value="large">
                                    Large
                                </option>
                                
                            </select>
                        </label>
                    <a href="{{  route('cart.show', $product->id)  }}" class="button  expanded">Add to Cart</a>
                </div>
            </div>
            <p class="text-left subheader"><small>* Trusted <a href="#">seller</a></small></p>
        </div>
    </div>
</div>
@endsection