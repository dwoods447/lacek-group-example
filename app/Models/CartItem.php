<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Cart;
use App\Models\CartItems;

class CartItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function cart()
    {
       return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
