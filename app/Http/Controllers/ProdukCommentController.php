<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Tag;
use App\Models\User;
use App\Models\Produk;
use App\Models\ProdukComment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukCommentController extends Controller
{

    public function store(Request $request , $id)
    {
      $this->validate($request, [
        'subject' => 'required|min:5',
      ]);

      $comment = ProdukComment::create([
          'subject' => $request->subject,
          'produk_id' => $id,
          'user_id' => Auth::user()->id
      ]);
      $produks = Produk::FindOrFail($id);
      return redirect('/produk/'.$produks->slug_produk);
    }
}
