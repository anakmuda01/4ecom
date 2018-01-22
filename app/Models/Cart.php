<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  public function user()
  {
      return $this->belongsTo('App\Models\User');
  }

  public function cartItems()
  {
      return $this->hasMany('App\Models\CartItem');
  }

  public function order()
  {
      return $this->belongsTo('App\Models\Order');
  }
}
