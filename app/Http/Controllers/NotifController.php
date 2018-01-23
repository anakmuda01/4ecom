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

class NotifController extends Controller
{
  public function index()
  {
    $user = Auth::user()->id;
    return view('home', compact('tags'));
  }

  public function kirimPesan(Request $request, $id)
  {
    $request->pesan_admin = array_diff($request->pesan_admin, [0]);
    if(empty($request->pesan_admin)){
      return redirect()->back()->with('pesan_error','Silahkan pilih pesan untuk pelanggan');
    }

    $user = User::find($id);

    $psn = $user->pesans->first();
    $x = $psn->pivot->where('user_id', $psn->pivot->user_id)->first();
    if($x){
      $user->pesans()->detach($x->pesan_id);
      // $user->pesans()->updateExistingPivot($x->pesan_id,['status'=>2]);
    }

    $user->pesans()->attach($request->pesan_admin,['status'=>2]);

    session()->flash('wow','Pesan ke Pelanggan Terkirim.');

    $c = Cart::where('user_id', $id)->first();
    return redirect('/admin/order/'.$c->id);
  }
}
