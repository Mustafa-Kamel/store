<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        return view('admin.product.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'          => 'required|string|min:3|max:100',
            'price'         => 'required|regex:/^\d*(\.\d{1,2})?$/',
            'size'          => 'required|string|min:1|max:100',
            'category_id'   => 'required|integer',
            'description'   => 'nullable|string|min:3',
            'image'         => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096'
        ]);
        $product = request(['name', 'description', 'size', 'price', 'category_id']);
        if ($request['image']) {
            $imageName = time().'-'.$request->image->getClientOriginalName();
            request()->image->move(public_path('images'), $imageName);
            $product['image'] = $imageName;
        }
        if(Product::create($product)){
            return redirect()->action('ProductController@index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if($product->delete()){
            if(file_exists(public_path('images/'.$product->image)))
                @unlink(public_path('images/'.$product->image));
        }
        return redirect()->back();
    }
}
