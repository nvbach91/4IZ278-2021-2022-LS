<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\ProductSize;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $primaryKey = "order_id";
    protected $fillable = ["user_id", "address_id", "status", "variable_symbol", "note"];

    public function product_size(): BelongsToMany
    {
        return $this->belongsToMany(ProductSize::class, 'product_size_order', 'order_id', 'product_size_id', "order_id", "product_size_id")->withPivot(["product_quantity"]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
