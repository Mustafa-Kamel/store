@extends('layouts.master') 

@section('title', 'Shipping Info')

@section('content')
<div class="row">
    <div class="small-6 small-centered columns"><br>
        <h2 class="text-center">Shipping Info</h2><br>
        <form action="{{ route('cart.shipping.store') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="address">Address Line</label>
                <input type="text" class="form-control" name="address" id="address">
            </div>
            <div class="form-group">
                <label for="country">Country</label>
                <input type="text" class="form-control" name="country" id="country">
            </div>
            <div class="form-group">
                <label for="state">State</label>
                <input type="text" class="form-control" name="state" id="state">
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" class="form-control" name="city" id="city">
            </div>
            <div class="form-group">
                <label for="zip">Zip Code</label>
                <input type="text" class="form-control" name="zip" id="zip">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" name="phone" id="phone">
            </div>
            <div class="text-center">
                <button type="submit" class="button">Proceed to payment</button>
            </div>
        </form><br><br>
    </div>
</div>
@endsection