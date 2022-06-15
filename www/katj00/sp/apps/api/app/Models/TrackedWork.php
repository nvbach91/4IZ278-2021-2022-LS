<?php

namespace App\Models;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * TrackedWork
 *
 * @mixin Builder
 */
class TrackedWork extends Model
{
    use TraitUuid, HasFactory;

    protected $fillable = [
        'project_id',
        'start_id',
        'end_id',
        'user_id'
    ];

    public function start(): \Illuminate\Database\Eloquent\Relations\HasOne|null
    {
        return $this->hasOne(Activity::class, 'start_id', 'id');
    }

    public function end(): \Illuminate\Database\Eloquent\Relations\HasOne|null
    {
        return $this->hasOne(Activity::class, 'end_id', 'id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo|null
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function project(): \Illuminate\Database\Eloquent\Relations\BelongsTo|null
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function activities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Activity::class, 'work_id', 'id');
    }
}
