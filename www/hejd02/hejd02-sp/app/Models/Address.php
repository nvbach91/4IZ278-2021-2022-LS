<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;
    protected $table = "addresses";
    protected $fillable = ["user_id", "region", "town", "street", "street_number", "zip"];

    public function user(): belongsTo
    {
        return $this->belongsTo(User::class, "user_id", "user_id");
    }

}
