<?php

namespace App\Models;

use App\Models\Attributes\CompanySizeAttribute;
use App\Models\Builders\CompanyBuilder;
use App\Models\Casts\CompanySizeCast;
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
 * @property CompanySizeAttribute|null $size
 * @property string|null $url
 * @property string|null $address
 * @property string|null $contact_email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @see Company::getSelectNameAttribute()
 * @property-read string $select_name
 *
 * @property-read list<Position> $positions
 * @property-read User $user
 *
 * @method static CompanyBuilder query()
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
        'size' => CompanySizeCast::class,
        'url' => 'string',
        'address' => 'string',
        'contact_email' => 'string',
    ];

    public function getSelectNameAttribute(): string
    {
        return "$this->id - $this->name";
    }

    public function positions(): HasMany
    {
        return $this->hasMany(Position::class, 'company_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'user');
    }

    public function newEloquentBuilder($query): CompanyBuilder
    {
        return new CompanyBuilder($query);
    }
}
