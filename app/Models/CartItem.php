<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'produk_id','jumlah_beli','cart_id','harga_total',
    ];

    public function cart()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function produk()
    {
        return $this->belongsTo('App\Models\Produk');
    }

    public function users(){
      return $this->belongsTo('App\Models\User');
    }

}
