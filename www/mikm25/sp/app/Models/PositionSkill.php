<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read int $id
 * @property int $fk_position_id
 * @property int $fk_skill_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PositionSkill extends Model
{
    use HasFactory;

    protected $table = 'position_skills';

    protected $fillable = [
        'fk_position_id',
        'fk_skill_id',
    ];

    protected $casts = [
        'fk_position_id' => 'integer',
        'fk_skill_id' => 'integer',
    ];
}
