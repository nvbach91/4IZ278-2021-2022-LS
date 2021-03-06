<?php

namespace App\Models;

use Carbon\Carbon;
use Database\Factories\BranchFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 *
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @see Branch::getTranslatedNameAttribute()
 * @property-read string $translated_name
 *
 * @property-read list<Position> $positions
 */
class Branch extends Model
{
    use HasFactory;

    protected $table = 'branches';

    protected $fillable = [
        'name',
    ];

    protected $casts = [
        'name' => 'string',
    ];

    public function getTranslatedNameAttribute(): string
    {
        /** @var string $translated */
        $translated = __("branches.$this->name");

        return $translated;
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class, 'branch_id', 'id');
    }

    protected static function newFactory(): BranchFactory
    {
        return new BranchFactory();
    }
}
