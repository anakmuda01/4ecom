<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Tag;
use App\Models\User;
use App\Models\Cart;
use App\Models\Pesan;
use App\Models\CartItem;
use App\Models\Produk;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function buatOrder(Request $request, $id)
    {
      $usr = Auth::user()->id;
      $this->validate($request, [
        'tanggal_kirim' => 'required',
      ]);

        $user = User::find($usr);
        $psn = $user->pesans->first();

        if(!$psn){
          $user->pesans()->attach(2);
        }

        $x = $psn->pivot->where('user_id',$usr)->first();
        if($x){
          $user->pesans()->updateExistingPivot($x->pesan_id,['status'=>2]);
        }

        $cart = Cart::where('user_id',Auth::user()->id)->first();
        $random = str_random(5);
        $cart->tgl_kirim = $request->tanggal_kirim;
        $cart->kode_random = $random;
        $cart->status = 2;
        $cart->save();

        return redirect('/pembayaran');
    }

    public function pembayaran(){
      $user = Auth::user()->id;
      $pesans = Pesan::all();
      $temu = ['user_id'=>$user, 'status'=> 2];
      $order = Cart::where($temu)
                    ->with('user')
                    ->first();

      if (empty($order)) {
        return view('produks.pembayaran',['order'=>$order]);
      }else {
        $ampunya = User::find($user);
        $psn = $ampunya->pesans->first();
        $pesan = $psn->tipe_pesan;
        $items = $order->cartItems;
        $hartot = 0;
        foreach ($items as $or){
          $hartot+=$or->harga_total;
        }
        return view('produks.pembayaran',['order'=>$order, 'hartot'=>$hartot, 'pesan'=>$pesan]);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $usr = Auth::user()->id;
      $user = User::find($usr);
      $psn = $user->pesans->first();
      $x = $psn->pivot->where('user_id',$usr)->first();
      if($x){
        $user->pesans()->updateExistingPivot($x->pesan_id,['status'=>1]);
      }

      $cart = Cart::where('user_id', $id)->first();
      if($cart)
        $cart->delete();
      else abort(403);

      return redirect('/pembayaran');
    }
}
