<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile()
    {
      return $this->hasOne('App\Models\Profile');
    }

    public function cart(){
      return $this->hasOne('App\Models\Cart');
    }

    public function order(){
      return $this->hasOne('App\Models\Order');
    }

    public function pesans()
    {
      return $this->belongsToMany('App\Models\Pesan')->withTimestamps()
                                                     ->withPivot('status');
    }

    public function isAdmin()
    {
      if($this->role == 2) return true;
      return false;
    }
}
