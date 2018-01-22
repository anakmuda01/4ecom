<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Tag;
use App\Models\User;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Produk;
use Illuminate\Http\Request;

class CartController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function addItem (Request $request, $produkId)
  {
    $id = Auth::user()->id;
    $user = User::find($id);
    $profile = $user->profile;
    if($profile->nama_user == 'belum diisi'){
      return redirect('/profile/'.$profile->id.'/edit');
    }
    if($profile->no_telpon == 'belum diisi'){
      return redirect('/profile/'.$profile->id.'/edit');
    }
    if(!$profile->alamat_user){
      return redirect('/profile/'.$profile->id.'/edit');
    }
    $cart = Cart::where('user_id',Auth::user()->id)->first();

    $produk = Produk::where('id', $produkId)->with('tags')->first();

    if(!$cart){
          $cart =  new Cart();
          $cart->user_id=Auth::user()->id;
          $cart->save();
    }else if($cart->status == 2){
      return redirect('/produk/'.$produk->slug_produk)->with('pay','Silahkan selesaikan pembayaran Order sebelumnya');
    }

    // if($cart->status==2){
    //   return redirect('/produk/'.$produk->slug_produk)->with('max','Silahkan selesaikan pembayaran Order sebelumnya');
    // }else if(!$cart){
    //     $cart =  new Cart();
    //     $cart->user_id=Auth::user()->id;
    //     $cart->save();
    // }

    $matchThese = ['cart_id' => $cart->id, 'produk_id' => $produkId,];
    $c = CartItem::where($matchThese)->first();


    if(!empty($c)){
        $tot = $c->jumlah_beli;
        if($tot>=80){
          return redirect('/produk/'.$produk->slug_produk)->with('max','Pembelian melebihi Maximum beli silahkan cek Keranjang Anda');
        } else {
          $tot = $c->jumlah_beli + $request->jumlah_beli ;
          $hatot = $tot * $produk->harga_produk;
          $c->produk_id=$produkId;
          $c->cart_id= $cart->id;
          $c->jumlah_beli=$tot;
          $c->harga_total=$hatot;
          $c->save();
          return redirect('/produk/'.$produk->slug_produk)->with('msg','Berhasil ditambahkan ke keranjang');
        }

    } else {

      $cartItem  = new Cartitem();
      $cartItem->produk_id=$produkId;
      $cartItem->cart_id= $cart->id;
      $cartItem->jumlah_beli= $request->jumlah_beli;
      $cartItem->harga_total= $request->jumlah_beli*$produk->harga_produk;

      $cartItem->save();
      return redirect('/produk/'.$produk->slug_produk)->with('msg','Berhasil ditambahkan ke keranjang');
    }

  }

  public function showCart(){
    $cart = Cart::where('user_id', Auth::user()->id)->first();

    if(!$cart){
          $cart =  new Cart();
          $cart->user_id=Auth::user()->id;
          $cart->save();
    }else if($cart->status == 2){
      return view('produks.keranjang')->with('max','Silahkan selesaikan pembayaran Order sebelumnya');
    }

    $items = $cart->cartItems;
    $subtotal=0;

    foreach($items as $item)
    {
      $subtotal+=$item->harga_total;
    }
    $totalbayar = $subtotal+50000;
    return view('produks.keranjang',['items'=>$items,'subtotal'=>$subtotal,'totalbayar'=>$totalbayar]);
    }

    public function removeItem($id){

        CartItem::destroy($id);
        return redirect('/');
  }

}
