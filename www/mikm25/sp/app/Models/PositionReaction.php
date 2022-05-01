<?php

namespace App\Models;

use App\Models\Builders\PositionReactionBuilder;
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
 *
 * @method static PositionReactionBuilder query()
 */
class PositionReaction extends Model
{
    use HasFactory;

    protected $table = 'position_reactions';

    protected $fillable = [
        'position_id',
    ];

    protected $casts = [
        'position_id',
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id', 'id', 'position');
    }

    public function newEloquentBuilder($query): PositionReactionBuilder
    {
        return new PositionReactionBuilder($query);
    }
}
