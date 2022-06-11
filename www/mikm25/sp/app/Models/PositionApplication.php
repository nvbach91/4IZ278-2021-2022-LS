<?php

namespace App\Models;

use App\Models\Builders\PositionApplicationBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 *
 * @property int $position_id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string $message
 * @property Carbon $created_at
 *
 * @property-read Position $position
 *
 * @method static PositionApplicationBuilder query()
 */
class PositionApplication extends Model
{
    use HasFactory;

    public const UPDATED_AT = null; // disable updated_at attribute

    protected $table = 'position_applications';

    protected $fillable = [
        'position_id',
        'name',
        'email',
        'phone',
        'message',
    ];

    protected $casts = [
        'position_id' => 'integer',
        'name' => 'string',
        'email' => 'string',
        'phone' => 'string',
        'message' => 'string',
    ];

    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'position_id', 'id', 'position');
    }

    public function newEloquentBuilder($query): PositionApplicationBuilder
    {
        return new PositionApplicationBuilder ($query);
    }
}
