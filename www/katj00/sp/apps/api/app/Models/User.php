<?php

namespace App\Models;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


/**
 * User
 *
 * @mixin Builder
 */
class User extends Authenticatable
{
    use TraitUuid, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'node_id',
        'email',
        'name',
        'username',
        'avatar_url',
        'last_synchronized'
    ];

    public function projects() {
        return $this->hasMany(Project::class, 'owner_id', 'id');
    }
}
