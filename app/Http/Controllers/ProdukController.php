<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Tag;
use App\Models\User;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $cari_p = urldecode($request->input('cari'));
        if(!empty($cari_p)){
            $produks = Produk::where('nama_produk', 'like', '%'.$cari_p.'%')
                  ->with('tags')
                  ->orderBy('created_at','desc')
                  ->paginate(9);

            $count = $produks->count();
            return view('produks.cariproduk',['produks'=>$produks])->with('count', $count);

        } else {
          $produks = Produk::where('status', 1)->with('tags')
                  ->orderBy('created_at','desc')
                  ->paginate(9);
          $count = $produks->count();
          return view('produks.cariproduk',['produks'=>$produks])->with('count', $count);
        }
        // Produk::inRandomOrder()->with('tags')
    }

    public function indexKategori(Request $request)
    {
      $produks = Produk::where('nama_produk', 'like', '%'.$cari_p.'%')
            ->with('tags')
            ->orderBy('created_at','desc')
            ->paginate(9);

      $count = $produks->count();
    }

    public function filter($tag){
      $tags = Tag::all();

      $produks = Produk::with('tags')->whereHas('tags', function($query) use($tag) {
                                        $query->where('slug_tag', $tag);
                                        })->orderBy('created_at','desc')
                                        ->paginate(9);

      $count = $produks->count();
      return view('produks.cariproduk',['produks'=>$produks])->with('count', $count);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , $id)
    {

    }

    // public function addCart(Request $request, $id)
    // {
    //   dd('woy');
    //   $usr = Auth::user()->id;
    //   $user = User::findOrFail($usr);
    //   $cok = $user->produks()->where('produk_id', $id)->first();
    //
    //   $z = 0;
    //   if(!empty($cok)){
    //     $z = $cok->pivot->jumlah_beli;
    //   }
    //
    //   $produk = Produk::where('id', $id)->with('tags')->first();
    //
    //   if($z>=80){
    //     return redirect('/produk/'.$produk->slug_produk)->with('max','Pembelian melebihi Maximum beli silahkan cek Keranjang Anda');
    //   } else {
    //     $jumlah_beli_baru = $request->jumlah_beli+$z;
    //     $a = $user->produks()->updateExistingPivot($id , ['jumlah_beli'=>$jumlah_beli_baru, 'total'=>$jumlah_beli_baru*$produk->harga_produk]);
    //     if($a == 0){
    //       $user->produks()->attach($id , ['jumlah_beli'=>$request->jumlah_beli, 'total'=>$request->jumlah_beli*$produk->harga_produk]);
    //     }
    //     $produk = Produk::where('id', $id)->with('tags')->first();
    //     return redirect('/produk/'.$produk->slug_produk)->with('msg','Berhasil ditambahkan ke keranjang');
    //   }
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      $produk = Produk::where('slug_produk', $slug)->with('tags')->first();
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
        //
    }
}
