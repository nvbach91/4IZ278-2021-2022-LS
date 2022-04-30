<?php

namespace App\Models;

use App\Models\Builders\UserBuilder;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * @property-read int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string|null $phone_number
 * @property string|null $remember_token
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @see User::setPasswordAttribute()
 * @property string $password
 *
 * @see User::getFullNameAttribute()
 * @property-read string $full_name
 *
 * @see User::getIsEmailVerifiedAttribute()
 * @property-read bool $is_email_verified
 *
 * @property-read list<Tag> $tags
 * @property-read list<Position> $positions
 * @property-read list<EmailVerification> $email_verifications
 * @property-read list<PasswordReset> $password_resets
 *
 * @method static UserBuilder query()
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'email_verified_at',
        'password',
        'phone_number',
        'remember_token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'firstname' => 'string',
        'lastname' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'phone_number' => 'string',
        'remember_token' => 'string',
    ];

    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function getFullNameAttribute(): string
    {
        return "$this->firstname $this->lastname";
    }

    public function getIsEmailVerifiedAttribute(): bool
    {
        return ! empty($this->email_verified_at);
    }

    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class, 'user_id', 'id');
    }

    public function emailVerifications(): HasMany
    {
        return $this->hasMany(EmailVerification::class, 'user_id', 'id');
    }

    public function passwordResets(): HasMany
    {
        return $this->hasMany(PasswordReset::class, 'user_id', 'id');
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class, 'user_id', 'id');
    }

    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }
}
