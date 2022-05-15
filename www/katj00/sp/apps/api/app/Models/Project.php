<?php

namespace App\Models;

use App\Traits\TraitUuid;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use TraitUuid, HasFactory;

    protected $fillable = [
        'node_id',
        'name',
        'owner_id',
        'visible',
        'pushed_at'
    ];

    public function owner() {
        return $this->belongsTo(User::class, 'id', 'owner_id');
    }
}
