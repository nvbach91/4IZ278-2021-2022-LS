<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSizeOrder extends Model
{
    use HasFactory;
    protected $primaryKey = "product_size_order_id";
    protected $table = "product_size_order";

}
