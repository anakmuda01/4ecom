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



Route::group(['middleware'=> 'admin'], function(){
  Route::get('/admin/produk', 'AdminController@listProduk')->name('adminProduk');
  Route::get('/admin/order', 'AdminController@listOrder')->name('adminOrder');
  Route::get('/admin/order/{id}', 'AdminController@Order')->name('Order');
  Route::post('/notif/{id}','NotifController@kirimPesan');
  Route::resource('admin', 'AdminController');
});

Route::group(['middleware'=> 'auth'], function(){
  Route::resource('profile','UserController');
  Route::post('/cart/{produkid}', 'CartController@addItem');
  Route::get('/keranjang', 'CartController@showCart');
  Route::post('/order/{cartid}', 'OrderController@buatOrder');
  Route::get('/pembayaran', 'OrderController@pembayaran');
  Route::delete('/pembayaran/{id}', 'OrderController@destroy');
  // Route::resource('profile','UserController', ['except'=>['index','show']]);
});

// Route::resource('profile','UserController', ['only'=>['index','show']]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/termurah', 'ProdukController@indexTermurah')->name('termurah');
Route::get('/produk/kategori/{slug_tag}', 'ProdukController@filter')->name('filter');
// Route::get('/c', function () {
//     return view('produks.cariproduk');
// });

// Route::get('/profile','UserController@create');
// Route::get('/profile/{id}','UserController@show');

Route::resource('produk', 'ProdukController');

Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');