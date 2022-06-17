<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $primaryKey = "category_id";
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return HasMany
     * @description get all posts for the category
     */
    public function product(): HasMany
    {
        return $this->hasMany(Product::class);
    }

}
