<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  public function user(){
    return $this->BelongsTo('App\Models\User');
  }

  public function cart(){
    return $this->BelongsTo('App\Models\Cart');
  }
}
