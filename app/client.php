<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'name', 'phone', 'address',
    ];

    public function orders(){
        return $this->hasMany('App\Order');
    }
}
