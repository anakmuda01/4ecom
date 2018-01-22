<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'nama_user', 'no_telpon', 'alamat_user', 'user_id',
    ];

    public function user(){
      return $this->belongsTo('App\Models\User');
    }

    public function isOwner(){
      return Auth::user()->id == $this->user_id;
    }
}
