<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'description', 'image', 'category_id', 'purchase_price', 'sale_price', 'stock',
    ];
    protected $appends = ['profit_percent'];

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function orders(){
        return $this->belongsToMany('App\Order');
    }

    public function getProfitPercentAttribute(){
        $profit = $this->sale_price - $this->purchase_price;
        $profit_percent = $profit * 100 / $this->purchase_price;
        return number_format($profit_percent,2);
    }
}
