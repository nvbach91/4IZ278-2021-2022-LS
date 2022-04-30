<?php

namespace App\Models;

use App\Models\Builders\EmailVerificationBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property string $token
 * @property int $user_id
 * @property bool $used
 * @property Carbon $valid_until
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @see EmailVerification::getIsValidAttribute()
 * @property-read bool $is_valid
 * @see EmailVerification::getIsUsableAttribute()
 * @property-read bool $is_usable
 * @see EmailVerification::getVerificationLinkAttribute()
 * @property-read string $verification_link
 *
 * @property-read User $user
 *
 * @method static EmailVerificationBuilder query()
 */
class EmailVerification extends Model
{
    use HasFactory;

    public const VALID_DAYS = 30;

    protected $table = 'email_verifications';

    protected $fillable = [
        'token',
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
        'verification_link',
    ];

    protected $casts = [
        'token' => 'string',
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

    public function getVerificationLinkAttribute(): string
    {
        return route('auth.email-verification.verify', [
            'token' => $this->token
        ]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'user');
    }

    public function newEloquentBuilder($query): EmailVerificationBuilder
    {
        return new EmailVerificationBuilder($query);
    }
}
