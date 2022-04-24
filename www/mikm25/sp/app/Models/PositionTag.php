<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int $fk_position_id
 * @property int $fk_tag_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PositionTag extends Model
{
    use HasFactory;

    protected $table = 'position_tags';

    protected $fillable = [
        'fk_position_id',
        'fk_tag_id',
    ];

    protected $casts = [
        'fk_position_id' => 'integer',
        'fk_tag_id' => 'integer',
    ];
}
