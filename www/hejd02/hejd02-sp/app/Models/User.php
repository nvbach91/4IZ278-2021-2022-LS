<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    protected $table = "users";
    protected $primaryKey = "user_id";
    protected $hidden = ["password", "created_at", "updated_at"];
    protected $fillable = ["first_name", 'last_name', 'phone', "email", "password", "role"];


    public function orders(): hasMany
    {
        return $this->hasMany(Order::class, "user_id", "user_id");
    }

    public function address(): hasMany
    {
        return $this->hasMany(Address::class, "user_id", "user_id");
    }
}
