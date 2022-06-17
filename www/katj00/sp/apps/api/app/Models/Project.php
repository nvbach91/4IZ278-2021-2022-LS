<?php

namespace App\Models;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * Project
 *
 * @mixin Builder
 */
class Project extends Model
{
    use TraitUuid, HasFactory;

    protected $fillable = [
        'node_id',
        'name',
        'user_id',
        'visible',
        'pushed_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function trackedWork()
    {
        return $this->hasMany(TrackedWork::class, 'project_id', 'id');
    }
}
