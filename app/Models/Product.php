<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Product extends Model
{
    protected $table = 'products';
    use HasFactory;
     public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'product_id');
    }

}
