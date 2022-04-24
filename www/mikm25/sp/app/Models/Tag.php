<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property-read int $id
 * @property int $fk_user_id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read User $user
 * @property-read list<Position> $positions
 */
class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'fk_user_id',
        'name',
    ];

    protected $casts = [
        'fk_user_id' => 'integer',
        'name' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'fk_user_id', 'id', 'user');
    }

    public function positions(): BelongsToMany
    {
        return $this->belongsToMany(Position::class, 'position_tags', 'fk_position_id', 'fk_tag_id', 'id', 'id', 'positions');
    }
}
