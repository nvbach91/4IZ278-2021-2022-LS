<?php

namespace App\Models;

use App\Models\Builders\PositionBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 *
 * @property int $user_id
 * @property int $branch_id
 * @property string $name
 * @property int|null $salary_from
 * @property int|null $salary_to
 * @property string|null $external_url
 * @property string $content
 * @property string $workplace_address
 * @property Carbon|null $valid_from
 * @property Carbon|null $valid_until
 * @property int|null $min_practice_length
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @see Position::getIsValidAttribute()
 * @property-read bool $is_valid
 *
 * @property-read User $user
 * @property-read Branch $branch
 * @property-read list<PositionClick> $clicks
 * @property-read list<PositionReaction> $reactions
 * @property-read Company|null $company null company means private job listing
 *
 * @method static PositionBuilder query()
 */
class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    protected $fillable = [
        'user_id',
        'branch_id',
        'name',
        'salary_from',
        'salary_to',
        'external_url',
        'content',
        'workplace_address',
        'valid_from',
        'valid_until',
        'min_practice_length',
        'clicked_times',
        'reacted_times',
    ];

    protected $appends = [
        'is_valid',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'branch_id' => 'integer',
        'name' => 'string',
        'salary_from' => 'integer',
        'salary_to' => 'integer',
        'external_url' => 'string',
        'content' => 'string',
        'workplace_address' => 'string',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'min_practice_length' => 'integer',
        'clicked_times' => 'integer',
        'reacted_times' => 'integer',
    ];

    public function getIsValidAttribute(): bool
    {
        $now = Carbon::now()->startOfDay();

        if ($this->valid_from instanceof Carbon && $this->valid_from->greaterThan($now)) {
            return false;
        }

        if ($this->valid_until instanceof Carbon && $this->valid_until->lessThan($now)) {
            return false;
        }

        return true;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'user');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id', 'branch');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'position_skills', 'skill_id', 'position_id', 'id', 'id', 'skills');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'position_tags', 'tag_id', 'position_id', 'id', 'id', 'tags');
    }

    public function clicks(): HasMany
    {
        return $this->hasMany(PositionClick::class, 'position_id', 'id');
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(PositionReaction::class, 'position_id', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id', 'company');
    }

    public function newEloquentBuilder($query): PositionBuilder
    {
        return new PositionBuilder($query);
    }
}
