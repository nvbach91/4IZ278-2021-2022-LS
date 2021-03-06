<?php

namespace App\Models;

use App\Models\Builders\UserBuilder;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

/**
 * @property-read int $id
 *
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string|null $phone_number
 * @property int|null $github_id
 * @property string|null $remember_token
 * @property Carbon|null $last_logged_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @see User::setPasswordAttribute()
 * @property string|null $password
 *
 * @see User::getFullNameAttribute()
 * @property-read string $full_name
 *
 * @see User::getIsEmailVerifiedAttribute()
 * @property-read bool $is_email_verified
 *
 * @see User::getIsFromGithubAttribute()
 * @property-read bool $is_from_github
 *
 * @property-read list<Tag> $tags
 * @property-read list<Position> $positions
 * @property-read list<Company> $companies
 * @property-read list<EmailVerification> $email_verifications
 * @property-read list<PasswordReset> $password_resets
 *
 * @method static UserBuilder query()
 */
class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'email_verified_at',
        'password',
        'phone_number',
        'github_id',
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
        'password' => 'string',
        'phone_number' => 'string',
        'github_id' => 'integer',
        'remember_token' => 'string',
        'email_verified_at' => 'datetime',
        'last_logged_at' => 'datetime',
    ];

    public function setPasswordAttribute(?string $password): void
    {
        $this->attributes['password'] = empty($password) ? $password : Hash::make($password);
    }

    public function getFullNameAttribute(): string
    {
        return "$this->firstname $this->lastname";
    }

    public function getIsEmailVerifiedAttribute(): bool
    {
        return ! empty($this->email_verified_at);
    }

    public function getIsFromGithubAttribute(): bool
    {
        return ! empty($this->github_id);
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

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'user_id', 'id');
    }

    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }

    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }
}
