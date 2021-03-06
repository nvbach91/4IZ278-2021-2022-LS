<?php

namespace App\Models;

use App\Models\Attributes\PositionWorkloadAttribute;
use App\Models\Builders\PositionBuilder;
use App\Models\Casts\PositionWorkloadCast;
use App\Models\Formatters\PositionFormatter;
use Carbon\Carbon;
use Database\Factories\PositionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @property-read int $id
 *
 * @property int $user_id
 * @property int $branch_id
 * @property PositionWorkloadAttribute $workload
 * @property int|null $company_id
 * @property string $name
 * @property string $slug
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
 * @see Position::getTitleNameAttribute()
 * @property-read string $title_name
 *
 * @see Position::getContentLengthAttribute()
 * @property-read int $content_length
 *
 * @property-read User $user
 * @property-read Branch $branch
 * @property-read Collection|list<Tag> $tags
 * @property-read Collection|list<PositionClick> $clicks
 * @property-read Collection|list<PositionReaction> $reactions
 * @property-read Collection|list<PositionApplication> $applications
 * @property-read Company|null $company null company means private job listing
 *
 * @property-read int|null $clicks_count
 * @property-read int|null $reactions_count
 *
 * @method static PositionBuilder query()
 */
class Position extends Model
{
    use HasFactory;
    use PositionFormatter;
    use Notifiable;

    protected $table = 'positions';

    protected $fillable = [
        'user_id',
        'branch_id',
        'workload',
        'company_id',
        'name',
        'salary_from',
        'salary_to',
        'external_url',
        'content',
        'workplace_address',
        'valid_from',
        'valid_until',
        'min_practice_length',
    ];

    protected $appends = [
        'is_valid',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'branch_id' => 'integer',
        'workload' => PositionWorkloadCast::class,
        'company_id' => 'integer',
        'name' => 'string',
        'salary_from' => 'integer',
        'salary_to' => 'integer',
        'external_url' => 'string',
        'content' => 'string',
        'workplace_address' => 'string',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'min_practice_length' => 'integer',
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

    public function isSalarySet(): bool
    {
        return ! empty($this->salary_from) && ! empty($this->salary_to);
    }

    public function isExternalUrlSet(): bool
    {
        return ! empty($this->external_url);
    }

    public function getContentLengthAttribute(): int
    {
        return Str::length(strip_tags($this->content));
    }

    public function getTitleNameAttribute(): string
    {
        return Str::limit($this->name, 25);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'user');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id', 'branch');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'position_tags', 'position_id', 'tag_id', 'id', 'id', 'tags');
    }

    public function clicks(): HasMany
    {
        return $this->hasMany(PositionClick::class, 'position_id', 'id');
    }

    public function reactions(): HasMany
    {
        return $this->hasMany(PositionReaction::class, 'position_id', 'id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(PositionApplication::class, 'position_id', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id', 'company');
    }

    protected static function newFactory(): PositionFactory
    {
        return new PositionFactory();
    }

    public function newEloquentBuilder($query): PositionBuilder
    {
        return new PositionBuilder($query);
    }
}
