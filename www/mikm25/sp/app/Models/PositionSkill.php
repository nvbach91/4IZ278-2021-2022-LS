<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 *
 * @property int $position_id
 * @property int $skill_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PositionSkill extends Model
{
    use HasFactory;

    protected $table = 'position_skills';

    protected $fillable = [
        'position_id',
        'skill_id',
    ];

    protected $casts = [
        'position_id' => 'integer',
        'skill_id' => 'integer',
    ];
}
