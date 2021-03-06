<?php

namespace App\Models;

use App\Models\Builders\PositionReactionBuilder;
use Carbon\Carbon;
use Database\Factories\PositionReactionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 *
 * @property int $position_id
 * @property Carbon $created_at
 *
 * @property-read Position $position
 *
 * @method static PositionReactionBuilder query()
 */
class PositionReaction extends Model
{
    use HasFactory;

    public const UPDATED_AT = null; // disable updated_at attribute

    protected $table = 'position_reactions';

    protected $fillable = [
        'position_id',
    ];

    protected $casts = [
        'position_id' => 'integer',
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id', 'id', 'position');
    }

    protected static function newFactory(): PositionReactionFactory
    {
        return new PositionReactionFactory();
    }

    public function newEloquentBuilder($query): PositionReactionBuilder
    {
        return new PositionReactionBuilder($query);
    }
}
