<?php

Route::get('/', 'FrontController@index')->name('home');
Route::get('/products', 'FrontController@products')->name('products');
Route::get('/product/{product}', 'FrontController@product')->name('product');


Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');
Route::get('/home', 'HomeController@index');

Route::resource('cart', 'CartController')->except(['create', 'store', 'edit']);
Route::get('shipping', 'CartController@shippingCreate')->name('cart.shipping.create');
Route::post('shipping', 'CartController@shippingStore')->name('cart.shipping.store');
Route::get('payment', 'CartController@paymentCreate')->name('cart.payment.create');
Route::post('payment', 'CartController@paymentStore')->name('cart.payment.store');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function(){
    Route::resource('category', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::get('orders/{type?}', 'OrdersController@index')->name('orders.index');
    Route::post('orders/{order}', 'OrdersController@deliver')->name('orders.deliver');
    Route::post('orders/{order}/un', 'OrdersController@unDeliver')->name('orders.undeliver');
    
    Route::get('/', function(){
        return view('admin.index');
    })->name('admin.index');
});