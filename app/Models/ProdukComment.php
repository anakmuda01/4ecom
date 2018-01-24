<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukComment extends Model
{
  protected $fillable = [
      'subject','produk_id','user_id',
  ];

  public function user(){
    return $this->belongsTo('App\Models\User');
  }

  public function produk(){
    return $this->belongsTo('App\Models\Produk');
  }
}
