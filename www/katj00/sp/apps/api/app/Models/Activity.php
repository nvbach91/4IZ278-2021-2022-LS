<?php

namespace App\Models;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Activity
 *
 * @mixin Builder
 */
class Activity extends Model
{
    use TraitUuid, HasFactory;

    protected $fillable = [
        'type',
        'work_id',
        'user_id'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo|null
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }

    public function trackedWork() {
        return $this->belongsTo(TrackedWork::class, 'id', 'work_id');
    }
}
