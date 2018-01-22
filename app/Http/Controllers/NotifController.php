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
    $user->pesans()->sync($request->pesan_admin);

    return redirect()->back()->with('msg','Pesan berhasil dikirim');
  }
}
