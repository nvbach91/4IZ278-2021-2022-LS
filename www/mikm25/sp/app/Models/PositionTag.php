<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int $position_id
 * @property int $tag_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PositionTag extends Model
{
    use HasFactory;

    protected $table = 'position_tags';

    protected $fillable = [
        'position_id',
        'tag_id',
    ];

    protected $casts = [
        'position_id' => 'integer',
        'tag_id' => 'integer',
    ];
}
