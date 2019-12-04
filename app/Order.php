<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id', 'total_price'
    ];

    public function client(){
        return $this->belongsTo('App\Client');
    }

    public function products(){
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }
}
