@extends('layouts.master') 

@section('title', 'Cart')

@section('content')
<div class="row">
    <div class="page-header" style="margin: 50px">
        <h2 class="text-center">Your Cart
            @if (!count($cartItems))
            <span>is empty</span>
        </h2>
    </div>
            @else
    </h2>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Product</th>
            {{--
            <th>Size</th> --}}
            <th width="80">Qty</th>
            <th>Price</th>
            <th>Subtotal</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cartItems as $row)
        <tr>
            <td scope="row">
                {{--  <p>{{ $row->id }}</p>  --}}
                <strong>{{ $row->name }}</strong>
                <p>{{ ($row->options->has('size') ? $row->options->size.' size' : '') }}</p>
            </td>
            <td>
                <form action="{{ route('cart.update', $row->rowId) }}" method="post">
                    {{ csrf_field() }} {{ method_field('PUT') }}
                    <input type="number" name="qty" id="product-{{ $row->id }}" min="0" value="{{ $row->qty }}">
                    <input type="submit" class="button" value="Update">
                </form>
            </td>
            <td>${{ $row->price }}</td>
            <td>${{ $row->subtotal }}</td>
            <td>
                <form action="{{ route('cart.destroy', $row->rowId) }}" method="post">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="button">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        <tfoot>
            <tr>
                <td colspan="2" scope="row">&nbsp;</td>
                <td>#Items</td>
                <td colspan="2">{{ Cart::count() }} item(s)</td>
            </tr>
            <tr>
                <td colspan="2" scope="row">&nbsp;</td>
                <td>Subtotal</td>
                <td colspan="2">${{ Cart::subtotal() }}</td>
            </tr>
            <tr>
                <td colspan="2" scope="row">&nbsp;</td>
                <td>Tax</td>
                <td colspan="2">${{ Cart::tax() }}</td>
            </tr>
            <tr>
                <td colspan="2" scope="row">&nbsp;</td>
                <td>Total</td>
                <td colspan="2">${{ Cart::total() }}</td>
            </tr>
            <tr>
                <td colspan="5" scope="row"><div class="text-center"><a class="button" href="{{ route('cart.shipping.create') }}">Proceed to checkout</a></div></td>
            </tr>
        </tfoot>
    </tbody>
</table>
@endif
</div>
@endsection