<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('/');

//product
Route::get('/product/management','ProductController@management')->name('product.management');
Route::get('/product/create','ProductController@create')->name('product.create');
Route::post('/product/save','ProductController@save')->name('product.save');
Route::get('/product/delete/{product_id}','ProductController@delete')->name('product.delete');
Route::get('/product/edit/{product_id}', 'ProductController@edit')->name('product.edit');
Route::get('/product/image/{filename}', 'ProductController@getImage')->name('product.image');
Route::post('/product/update', 'ProductController@update')->name('product.update');
Route::get('/product/detail/{product_id}', 'ProductController@detail')->name('product.detail');

//Cart
Route::get('/cart/index', 'CartController@index')->name('cart.index');
Route::get('/cart/add/{product_id}', 'CartController@add')->name('cart.add');
Route::get('/cart/clear', 'CartController@clear')->name('cart.clear');
Route::get('/cart/remove/{producto_id}', 'CartController@remove')->name('cart.remove');
Route::get('/cart/up/{producto_id}', 'CartController@up')->name('cart.up');
Route::get('/cart/down/{producto_id}', 'CartController@down')->name('cart.down');

//category
Route::get('/category/index', 'CategoryController@index')->name('category.index');
Route::get('/category/create', 'CategoryController@create')->name('category.create');
Route::get('/category/delete/{category_id}', 'CategoryController@delete')->name('category.delete');
Route::post('/category/save', 'CategoryController@save')->name('category.save');
Route::get('/category/edit/{category_id}', 'CategoryController@edit')->name('category.edit');
Route::post('/category/update', 'CategoryController@update')->name('category.update');

//order 

Route::get('/order/index', 'OrderController@index')->name('order.index');
Route::post('/order/save', 'OrderController@save')->name('order.save');
Route::get('/order/management', 'OrderController@management')->name('order.management');
Route::get('/order/detail/{id}', 'OrderController@detail')->name('order.detail');
Route::post('/order/update', 'OrderController@update')->name('order.update');
//payment
Route::get('/payment/pay','PaymentController@payWithPaypal')->name('payment.paypal');
Route::get('/pay/status','PaymentController@status')->name('payment.status');
