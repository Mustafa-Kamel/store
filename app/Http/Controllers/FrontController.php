<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class FrontController extends Controller
{
    public function index(){
        $products = Product::latest()/* ->limit(4) */->get();
        return view('front.index', compact('products'));
    }

    public function products(){
        $products = Product::latest()/* ->limit(4) */->get();
        return view('front.products', compact('products'));
    }
    
    public function product(Product $product){
        return view('front.product', compact('product'));
    }
}
