<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Size extends Model
{
    use HasFactory;
    protected $table = "sizes";
    protected $primaryKey = "size_id";
    protected $fillable = ['size_type'];
    protected $hidden = ['laravel_through_key', 'created_at', 'updated_at'];

    public function products():BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_size', 'size_id', 'product_id');
    }
}
