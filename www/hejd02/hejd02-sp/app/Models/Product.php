<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{

    use HasFactory;
    protected $primaryKey = 'product_id';
    protected $fillable = ['product_name', 'price', 'color', 'category_id', 'description', 'sizes'];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];



    public function size():BelongsToMany
    {
        return $this->belongsToMany(Size::class, 'product_size',  'product_id', 'size_id')
            ->withPivot('remaining_quantity')
            ->withTimestamps();
    }

    /**
     * @return belongsTo
     * @description get all posts for the category
     */
    public function category(): belongsTo
    {
        return $this->belongsTo(Category::class, "category_id");
    }
}
