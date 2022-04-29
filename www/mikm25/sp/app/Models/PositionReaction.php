<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property int $position_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read Position $position
 */
class PositionReaction extends Model
{
    use HasFactory;

    protected $table = 'position_reaction';

    protected $fillable = [
        'position_id'
    ];

    protected $casts = [
        'position_id'
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id', 'id', 'position');
    }
}
