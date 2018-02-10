@extends('admin.layouts.master')

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Client</th>
                <th>Total</th>
                <th>Summary</th>
                <th>Time</th>
                <th>Delivered</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td scope="row">{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->total }}</td>
                    <td>
                        @foreach ($order->products as $product)
                            {{ $product->pivot->qty }} <strong>{{ $product->name }}</strong> - {{ $product->size }} size <br>
                        @endforeach
                    </td>
                    <td>{{ $order->created_at->toDayDateTimeString() }}</td>
                    <td>
                        @if ($order->delivered)
                            yes <br>
                            <form action="{{ route('orders.undeliver', $order->id) }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-xs"><small>NO</small></button>
                            </form>
                        @else
                            <form action="{{ route('orders.deliver', $order->id) }}" method="post">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success btn-sm"><small>Delivered</small></button>
                            </form>
                        @endif
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection