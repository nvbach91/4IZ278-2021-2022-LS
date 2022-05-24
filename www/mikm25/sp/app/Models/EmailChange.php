<?php

namespace App\Models;

use App\Models\Builders\EmailChangeBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 *
 * @property string $token
 * @property string $email
 * @property int $user_id
 * @property bool $used
 * @property Carbon $valid_until
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @see EmailChange::getIsValidAttribute()
 * @property-read bool $is_valid
 *
 * @see EmailChange::getIsUsableAttribute()
 * @property-read bool $is_usable
 *
 * @see EmailChange::getEmailChangeLinkAttribute()
 * @property-read string $email_change_link
 *
 * @property-read User $user
 *
 * @method static EmailChangeBuilder query()
 */
class EmailChange extends Model
{
    use HasFactory;

    public const VALID_DAYS = 30;

    protected $table = 'email_changes';

    protected $fillable = [
        'token',
        'email',
        'user_id',
        'used',
        'valid_until',
    ];

    protected $attributes = [
        'used' => false,
    ];

    protected $appends = [
        'is_valid',
        'is_usable',
        'password_reset_link',
    ];

    protected $casts = [
        'token' => 'string',
        'email' => 'string',
        'user_id' => 'integer',
        'used' => 'boolean',
        'valid_until' => 'date',
    ];

    public function getIsValidAttribute(): bool
    {
        $now = Carbon::now()->startOfDay();

        return $this->valid_until->greaterThan($now);
    }

    public function getIsUsableAttribute(): bool
    {
        return $this->is_valid && ! $this->used;
    }

    public function getEmailChangeLinkAttribute(): string
    {
        return route('auth.email-change.change', [
            'token' => $this->token,
        ]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'user');
    }

    public function newEloquentBuilder($query): EmailChangeBuilder
    {
        return new EmailChangeBuilder($query);
    }
}
