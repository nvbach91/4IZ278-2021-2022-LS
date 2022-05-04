<?php

namespace App\Models;

use App\Models\Builders\TagBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read int $id
 *
 * @property int $user_id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read User $user
 * @property-read list<Position> $positions
 *
 * @method static TagBuilder query()
 */
class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'user_id',
        'name',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'name' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'user');
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'position_tags', 'position_id', 'tag_id', 'id', 'id', 'positions');
    }

    public function newEloquentBuilder($query): TagBuilder
    {
        return new TagBuilder($query);
    }
}
