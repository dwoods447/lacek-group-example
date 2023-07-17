<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = []; 

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'id');
    }
}
