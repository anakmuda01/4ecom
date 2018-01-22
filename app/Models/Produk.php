<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
  protected $fillable = [
      'nama_produk','slug_produk','harga_produk','gambar_produk', 'deskripsi_produk',
  ];

  public function tags()
  {
    return $this->belongsToMany('App\Models\Tag');
  }

  public function getRouteKey()
  {
      return $this->slug_produk;
  }

  public function cartItem(){
    return $this->hasOne('App\Models\CartItem');
  }

}
