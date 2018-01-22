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

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function listProduk(){
      $produks = Produk::where('status', 1)
              ->with('tags')
              ->orderBy('created_at','desc')
              ->paginate(12);
      return view('admin.listproduk',['produks'=>$produks]);
    }

    public function listOrder(){
      $orders = Cart::where('status', 2)
              ->with('user')
              ->orderBy('created_at','desc')
              ->paginate(12);

      return view('admin.listorder',['orders'=>$orders]);
    }

    public function Order($id){
      $pesans = Pesan::all();
      $temu = ['id'=>$id, 'status'=> 2];
      $order = Cart::where($temu)
                    ->with('user')
                    ->first();

      $user = User::find($order->user->id);
      $psn = $user->pesans()->where('user_id', $order->user->id)->first();
      if(!$psn){
        $user->pesans()->attach(1);
      }
      $items = $order->cartItems;
      $hartot = 0;
      foreach ($items as $or){
        $hartot+=$or->harga_total;
      }
      return view('admin.orderid',['user'=>$user, 'order'=>$order, 'hartot'=>$hartot, 'pesans'=>$pesans]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.addproduk', compact('tags'));
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
      'nama_produk' => 'required|unique:produks|min:5|max:180',
      'harga_produk' => 'required|min:4|max:10',
      'deskripsi_produk' => 'required|min:5|max:2500',
      'gambar_produk' => 'required|min:5|max:180',
      ]);

      $request->kategori_produk = array_diff($request->kategori_produk, [0]);
      if(empty($request->kategori_produk)){
        return redirect('/admin/create')->withInput($request->input())->with('tag_error','Silahkan pilih Kategori Produk');
      }

      $produk = Produk::create([
      'nama_produk' => $request->nama_produk,
      'slug_produk' => str_slug($request->nama_produk,'-'),
      'harga_produk' => $request->harga_produk,
      'gambar_produk' => $request->gambar_produk,
      'deskripsi_produk' => $request->deskripsi_produk,
      ]);

      $produk->tags()->attach($request->kategori_produk);

      return redirect('/admin/produk')->with('msg','Produk Berhasil ditambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $produk = Produk::where('slug_produk', $slug)->first();
      if(!$produk)
        abort(404);
      return view('produks.single',compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $produk = Produk::findOrFail($id);
      $tags = Tag::all();
      if($produk)
        return view('admin.editproduk',['produk'=>$produk,'tags'=>$tags]);
      abort(404);
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
      $this->validate($request, [
        'nama_produk' => 'required|min:5|max:180',
        'harga_produk' => 'required|min:4|max:10',
        'deskripsi_produk' => 'required|min:5|max:2500',
        'gambar_produk' => 'required|min:5|max:180',
      ]);

      $request->kategori_produk = array_diff($request->kategori_produk, [0]);
      if(empty($request->kategori_produk)){
        return redirect()->back()->withInput($request->input())->with('tag_error','Silahkan pilih Kategori Produk');
      }

      $produk = Produk::findOrFail($id);
      if($produk)
        $produk->update([
          'slug_produk' => str_slug($request->nama_produk,'-'),
          'harga_produk' => $request->harga_produk,
          'gambar_produk' => $request->gambar_produk,
          'deskripsi_produk' => $request->deskripsi_produk,
        ]);
      else abort(403);

      $produk->tags()->sync($request->kategori_produk);
      return redirect('/admin/produk')->with('msg','Berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $produk = Produk::findOrFail($id);
      $user = Auth::user()->role;
      if($user == 2)
      $produk->delete();
      else abort(403);

      return redirect('/admin/produk')->with('msg','Berhasil di Hapus');
    }
}
