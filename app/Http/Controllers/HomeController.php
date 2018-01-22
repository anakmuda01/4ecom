<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Tag;
use App\Models\Produk;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tags = Tag::all();
      $produks = Produk::inRandomOrder()->paginate(4);

      return view('home',['tags'=> $tags, 'produks'=>$produks]);
    }

    public function login1st(){
      return redirect('/login');
    }
}
