<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property-read int $id
 *
 * @property int $user_id ID of user which the company belongs to
 * @property string $name
 * @property string|null $size
 * @property string|null $url
 * @property string|null $address
 * @property string|null $contact_email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @property-read list<Position> $positions
 * @property-read User $user
 */
class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'user_id',
        'name',
        'size',
        'url',
        'address',
        'contact_email',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'name' => 'string',
        'size' => 'string',
        'url' => 'string',
        'address' => 'string',
        'contact_email' => 'string',
    ];

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class, 'company_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'user');
    }
}
