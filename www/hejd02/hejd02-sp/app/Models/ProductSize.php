<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductSize extends Model
{
    use HasFactory;
    protected  $table = 'product_size';
    protected  $fillable = ['remaining_quantity', 'size_id', 'product_id'];


    public function order():BelongsToMany
    {
        return $this->belongsToMany(Order::class, 'product_size_order', 'product_size_id', 'order_id');
    }

    public function product():HasMany
    {
        return $this->HasMany(Product::class, 'product_id', 'product_id');
    }

    public function size():HasMany
    {
        return $this->HasMany(Size::class, 'size_id', 'size_id');
    }
}
