<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cart;

class CartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'update', 'destroy']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartItems = Cart::content();
        return view('cart.index', compact('cartItems'));
    }

    /**
     * Add the specified resource.
     *
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        Cart::add($product->id, $product->name, 1, $product->price, ['size' => $product->size]);
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  integer  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Cart::update($id, $request['qty']);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::remove($id);
        return redirect()->back();
    }
    
    /**
     * View the shipping form.
     *
     * @return \Illuminate\Http\Response
     */
    public function shippingCreate()
    {
        return view('cart.shipping');
    }
    
    /**
     * Process a shipping.
     *
     * @return \Illuminate\Http\Response
     */
    public function shippingStore()
    {
        // Validate the shipping form data
        
        // Process the shipping

        // Redirect to the payment form
        return redirect()->route('cart.payment.create');
    }
    
    /**
     * View the payment form.
     *
     * @return \Illuminate\Http\Response
     */
    public function paymentCreate()
    {
        return view('cart.payment');
    }
    
    /**
     * Process a payment.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function paymentstore()
    {
        \Stripe\Stripe::setApiKey(config('services.stripe.secret'));
        try{
            $charge = \Stripe\Charge::create(array(
            "amount"        => Cart::total(2, '.', '')*100,
            "currency"      => "usd",
            "description"   => 'Store Purchase',
            "source"        => request()->stripeToken,
            ));
        } catch(\Stripe\Error\Card $e){
            echo 'Error Message: ' . $e->message . '<br> Decline Code: ' . $e->getDeclineCode();
            echo 'Stripe Code: ' . $e->getStripeCode() . '<br> Stripe Parameter: ' . $e->getStripeParam();
        }

        $this->createOrder();
        Cart::destroy();
        return redirect()->route('home')->with('status', 'Order placed successfully');
    }
    
    public function createOrder()
    {
        $order = auth()->user()->orders()->create(['total' => Cart::total()]);

        foreach(Cart::content() as $item) {
            $order->products()->attach($item->id, ['qty' => $item->qty, 'subtotal' => $item->total]);
        }

        return true;
    }
}
