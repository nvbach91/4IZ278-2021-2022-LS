<?php

namespace App\Models;

use App\Models\Builders\PositionClickBuilder;
use Carbon\Carbon;
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
 * @method static PositionClickBuilder query()
 */
class PositionClick extends Model
{
    use HasFactory;

    public const UPDATED_AT = null; // disable updated_at attribute

    protected $table = 'position_clicks';

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

    public function newEloquentBuilder($query): PositionClickBuilder
    {
        return new PositionClickBuilder($query);
    }
}
