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
 * @property int $fk_branch_id
 * @property string $name
 * @property int|null $salary_from
 * @property int|null $salary_to
 * @property string|null $external_url
 * @property string $content
 * @property string $workplace_address
 * @property Carbon|null $valid_from
 * @property Carbon|null $valid_until
 * @property string $company_name
 * @property string $company_size
 * @property int|null $min_practice_length
 * @property int $clicked_times
 * @property int $reacted_times
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read boolean $is_valid
 *
 * @property-read User $user
 * @property-read Branch $branch
 */
class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    protected $fillable = [
        'fk_user_id',
        'fk_branch_id',
        'name',
        'salary_from',
        'salary_to',
        'external_url',
        'content',
        'workplace_address',
        'valid_from',
        'valid_until',
        'company_name',
        'company_size',
        'min_practice_length',
        'clicked_times',
        'reacted_times',
    ];

    protected $casts = [
        'fk_user_id' => 'integer',
        'fk_branch_id' => 'integer',
        'name' => 'string',
        'salary_from' => 'integer',
        'salary_to' => 'integer',
        'external_url' => 'string',
        'content' => 'string',
        'workplace_address' => 'string',
        'valid_from' => 'date',
        'valid_until' => 'date',
        'company_name' => 'string',
        'company_size' => 'string',
        'min_practice_length' => 'integer',
        'clicked_times' => 'integer',
        'reacted_times' => 'integer',
    ];

    public function getIsValidAttribute(): bool
    {
        $now = Carbon::now();

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
        return $this->belongsTo(User::class, 'fk_user_id', 'id', 'user');
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class, 'fk_branch_id', 'id', 'branch');
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'position_skills', 'fk_skill_id', 'fk_position_id', 'id', 'id', 'skills');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'position_tags', 'fk_tag_id', 'fk_position_id', 'id', 'id', 'tags');
    }
}
