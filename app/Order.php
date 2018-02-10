<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['total', 'delivered'];
    
    public function products()
    {
        return $this->belongsToMany(Product::Class)->withPivot('qty', 'subtotal');
    }

    public function user()
    {
        return $this->belongsTo(User::Class);
    }
}
